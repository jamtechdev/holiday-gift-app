<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $password = !empty($row['password']) ? $row['password'] : 'password123';

        // Handle both 'customer' field (full name) and separate first_name/last_name
        $firstName = $row['first_name'] ?? '';
        $lastName = $row['last_name'] ?? '';

        // If customer field exists but first_name/last_name don't, try to split customer name
        if (empty($firstName) && empty($lastName) && !empty($row['customer'])) {
            $nameParts = explode(' ', trim($row['customer']), 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
        }

        return new User([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => trim(($firstName ?? '') . ' ' . ($lastName ?? '')), // Keep name for backward compatibility
            'email' => $row['email'] ?? '',
            'password' => Hash::make($password),
            'street_address' => $row['street_address'] ?? $row['street address'] ?? null,
            'apt_suite_unit' => $row['apt_suite_unit'] ?? $row['apt., suite, unit'] ?? $row['apt suite unit'] ?? null,
            'city' => $row['city'] ?? null,
            'state' => $row['state'] ?? null,
            'zip' => $row['zip'] ?? null,
            'country' => $row['country'] ?? null,
            'role' => 'user',
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'customer' => 'nullable|string|max:255',
        ];
    }
}

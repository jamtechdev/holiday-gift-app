<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row)
    {
        $password = !empty($row['password']) ? $row['password'] : 'Holiday2025';

        // Handle both 'customer' field (full name) and separate first_name/last_name
        $firstName = $row['first_name'] ?? '';
        $lastName = $row['last_name'] ?? '';

        // If customer field exists but first_name/last_name don't, try to split customer name
        if (empty($firstName) && empty($lastName) && !empty($row['customer'])) {
            $nameParts = explode(' ', trim($row['customer']), 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
        }

        $email = $row['email'] ?? '';

        if (empty($email)) {
            // Skip rows without email
            return null;
        }

        // Check if user with this email exists
        $existingUser = User::where('email', $email)->first();

        // Skip admin users - don't change anything for admin users
        if ($existingUser && $existingUser->hasRole('admin')) {
            return null;
        }

        // Prepare data array
        $userData = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => trim(($firstName ?? '') . ' ' . ($lastName ?? '')),
            'street_address' => $row['street_address'] ?? $row['street address'] ?? null,
            'apt_suite_unit' => $row['apt_suite_unit'] ?? $row['apt., suite, unit'] ?? $row['apt suite unit'] ?? null,
            'city' => $row['city'] ?? null,
            'state' => $row['state'] ?? null,
            'zip' => $row['zip'] ?? null,
            'country' => $row['country'] ?? null,
            'role' => 'user',
        ];

        // If user exists (and is not admin), update only the provided fields
        if ($existingUser) {
            // Update existing user - only update fields that are provided
            $existingUser->update($userData);
            // Update password only if provided in import
            if (!empty($row['password'])) {
                $existingUser->update(['password' => Hash::make($password)]);
            }
            return $existingUser;
        }

        // If user doesn't exist, create new user
        $userData['email'] = $email;
        $userData['password'] = Hash::make($password);
        return User::create($userData);
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'customer' => 'nullable|string|max:255',
        ];
    }
}

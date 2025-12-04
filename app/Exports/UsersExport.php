<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('first_name', 'last_name', 'email', 'street_address', 'apt_suite_unit', 'city', 'state', 'zip', 'country')->get()->map(function($user) {
            $firstName = $user->first_name ?? '';
            $lastName = $user->last_name ?? '';
            $customer = trim($firstName . ' ' . $lastName);

            return [
                'customer' => $customer ?: '',
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $user->email,
                'password' => '',
                'street_address' => $user->street_address ?? '',
                'apt_suite_unit' => $user->apt_suite_unit ?? '',
                'city' => $user->city ?? '',
                'state' => $user->state ?? '',
                'zip' => $user->zip ?? '',
                'country' => $user->country ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return ['Customer', 'First Name', 'Last Name', 'Email', 'Password', 'Street Address', 'Apt., Suite, Unit', 'City', 'State', 'Zip', 'Country'];
    }
}

<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function __construct(private readonly ?string $search = null)
    {
    }

    public function collection()
    {
        $query = User::select('first_name', 'last_name', 'email', 'street_address', 'apt_suite_unit', 'city', 'state', 'zip', 'country')
            ->where('role', 'user');

        // Apply search filter if provided
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('first_name', 'like', "%{$this->search}%")
                    ->orWhere('last_name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('street_address', 'like', "%{$this->search}%")
                    ->orWhere('apt_suite_unit', 'like', "%{$this->search}%")
                    ->orWhere('city', 'like', "%{$this->search}%")
                    ->orWhere('state', 'like', "%{$this->search}%")
                    ->orWhere('zip', 'like', "%{$this->search}%")
                    ->orWhere('country', 'like', "%{$this->search}%");
            });
        }

        return $query->get()->map(function($user) {
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

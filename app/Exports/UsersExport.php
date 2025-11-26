<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('name', 'email')->get()->map(function($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'password' => ''
            ];
        });
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Password'];
    }
}
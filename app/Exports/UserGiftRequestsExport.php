<?php

namespace App\Exports;

use App\Models\UserGiftRequest;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserGiftRequestsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private readonly ?int $categoryId = null)
    {
    }

    public function collection(): Collection
    {
        $query = UserGiftRequest::with('category')->orderByDesc('created_at');

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email',
            'Category',
            'Street Address',
            'Street Address 2',
            'City',
            'State',
            'Postal Code',
            'Country',
            'Company',
            'Telephone',
            'Country Code',
            'Charity Selection',
            'Submitted At',
        ];
    }

    public function map($request): array
    {
        $phoneNumber = $request->telephone ?? '';
        
        return [
            $request->name,
            $request->lastname ?? '',
            $request->email,
            $request->category?->name ?? 'Uncategorized',
            $request->street_address,
            $request->street_address2 ?? '',
            $request->city,
            $request->state,
            $request->zip,
            $request->country ?? '',
            $request->company ?? '',
            $phoneNumber,
            $request->country_code ?? '',
            $request->charity_selection ?? '',
            $request->created_at?->format('Y-m-d H:i'),
        ];
    }
}


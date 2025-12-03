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
            'Name',
            'Email',
            'Category',
            'Street Address',
            'City',
            'State',
            'Zip',
            'Company',
            'Telephone',
            'Submitted At',
        ];
    }

    public function map($request): array
    {
        $phoneNumber = $request->telephone ?? '';
        if ($request->country_code) {
            $phoneNumber = $request->country_code . ' ' . $phoneNumber;
        }
        
        return [
            $request->name,
            $request->email,
            $request->category?->name ?? 'Uncategorized',
            $request->street_address,
            $request->city,
            $request->state,
            $request->zip,
            $request->company,
            $phoneNumber,
            $request->created_at?->format('Y-m-d H:i'),
        ];
    }
}


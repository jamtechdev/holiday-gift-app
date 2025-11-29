<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    /**
     * Scope to exclude donation categories (case-insensitive).
     */
    public function scopeExcludeDonation($query)
    {
        return $query->whereRaw('LOWER(name) != ?', ['donation']);
    }
}


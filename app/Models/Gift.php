<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'image',
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}


<?php

namespace App\Models;

use Database\Factories\PizzaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    /** @use HasFactory<PizzaFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'size_cm',
        'is_spicy',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_spicy' => 'boolean',
            'is_available' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

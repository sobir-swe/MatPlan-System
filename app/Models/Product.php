<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function product_materials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductMaterial::class);
    }
}

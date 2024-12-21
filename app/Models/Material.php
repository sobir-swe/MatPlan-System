<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;
    protected $fillable = ['name'];

    protected $hidden = ['id'];

    public function product_materials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductMaterial::class);
    }
}

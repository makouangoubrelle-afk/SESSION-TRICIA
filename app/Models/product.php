<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'barcode', 
        'supplier', 
        'price', 
        'current_stock', 
        'stock_min'
    ];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
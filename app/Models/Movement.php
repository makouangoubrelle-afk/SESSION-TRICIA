<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movement extends Model
{
    use HasFactory;

    // Cette ligne autorise Laravel à enregistrer ces données
    protected $fillable = ['product_id', 'quantity', 'type'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

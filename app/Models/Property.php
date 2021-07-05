<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'fabric',
        'weight',
        'insulation',
        'sleeve',
        'closure',
        'pocket',
        'about',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Product;

class Quantity extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'size_id',
        'quantity',
    ];
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

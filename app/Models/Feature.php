<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Product;


class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'feature',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

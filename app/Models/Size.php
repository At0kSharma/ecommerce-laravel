<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quantity;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'size',
    ];
    public function quantity(){
        return $this->hasMany(Quantity::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

class Orderbook extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address_id',
        'order',
        'payment',
    ];
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orderbook;
use App\Models\User;
class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'name',
        'street',
        'city',
        'state',
        'zipcode',
        'country',
    ];
    public function orderbook(){
        return $this->hasMany(Orderbook::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}

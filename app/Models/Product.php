<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;
use App\Models\Quantity;
use App\Models\Feature;
use App\Models\Photo;
use App\Models\Property;

use Cart;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'discount',
        'type',
        'body',
        'image',
        'preview',
        'thumbnail',
    ];

    public function reviewBy(User $user){
        return $this->ratings->contains('user_id',$user->id);   
    }
    
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function quantity(){
        return $this->hasMany(Quantity::class);
    }
    public function photo(){
        return $this->hasMany(Photo::class);
    }
    public function feature(){
        return $this->hasMany(Feature::class);
    }
    public function property(){
        return $this->hasOne(Property::class);
    }
}

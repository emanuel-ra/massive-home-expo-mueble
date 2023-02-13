<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteDetail extends Model
{
    use HasFactory;

    public function Product(){ 
        return $this->hasOne(Product::class, 'id','product_id')->select('id','code','name','image');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSheetSpecifications extends Model
{
    use HasFactory;

    public function subs(){ 
        return $this->hasMany(ProductSheetSubSpecifications::class,'specifications_id','id');
    }
}

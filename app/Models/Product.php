<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function Gallery(){ 
        return $this->hasMany(ProductGallery::class);
    }

    public function Content(){ 
        return $this->hasMany(ProductSheetContent::class);
    }
    public function Description(){ 
        return $this->hasOne(ProductSheetDescription::class);
    }
    public function Specifications(){ 
        return $this->hasMany(ProductSheetSpecifications::class)->with('subs:specifications_id,description,module,order_number');
    }
}

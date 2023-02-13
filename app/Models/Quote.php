<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;

class Quote extends Model
{
    use HasFactory;

    public function User(){ 
        return $this->hasOne(User::class, 'id','attended_by')->select('id','name');
    }
    public function Prospect(){ 
        return $this->hasOne(Prospect::class, 'id','prospect_id')->select('id','name');
    }
    public function Detail(){ 
        return $this->hasMany(QuoteDetail::class, 'quote_id','id')->with('Product');
    }
}

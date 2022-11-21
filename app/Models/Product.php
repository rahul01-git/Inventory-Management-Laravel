<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','brand','supplier_id','category_id','image'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function Supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
}

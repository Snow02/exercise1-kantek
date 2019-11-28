<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{

    protected $fillable = ['attribute_id','value'];
    protected $hidden = ['created_at','updated_at'];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class, 'products_attributes_values');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'parent_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function products(){
        return $this->belongsToMany(Product::class,'products_categories');
    }
}

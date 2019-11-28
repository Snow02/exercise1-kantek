<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->nonOptimized();
    }

    protected $fillable = ['title', 'price','desc','content','category_id','admin_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function categories(){
        return $this->belongsToMany(Category::class,'products_categories')->withTimestamps();
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function attributes_values(){
        return $this->belongsToMany(AttributeValue::class, 'products_attributes_values');
    }
}

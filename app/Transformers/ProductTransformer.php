<?php
namespace App\Transformers;

use App\Models\Product;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['media','attributes_values'];


    public function transform(Product $product)
    {
        $media_urls =[];
        foreach($product->media as $media){
            $media_urls[] = [
                'origin_url' => $media->getFullUrl(),
                'thumbnail_url' =>$media->getFullUrl('thumb'),
            ];
        }
        $product->avatar = count($media_urls) ? $media_urls[0] : Null ;

        $attribute = [];
        foreach($product->attributes_values as $attr){
            $attribute[] = $attr->value;
        }
        $categories = $product->categories->pluck('title');
        return [
            'id' => $product->id,
            'title' => $product->title,
            'desc' => $product->desc,
            'content' => $product->content,
            'attributes' => $attribute,
            'images' => $media_urls,
            'avatar' => $product->avatar,
            'categories' => $categories,

        ];
    }



}
?>

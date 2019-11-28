<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class ProductController extends Controller
{
    private $fractal;
    private  $productTransformer;
    public function __construct(Manager $fractal,ProductTransformer $productTransformer)
    {
        $this->fractal = $fractal;
        $this->productTransformer = $productTransformer;
    }
    public function formatProductData($product){
        $product = new Collection($product, $this->productTransformer); // Create a resource collection transformer
        return  $this->fractal->createData($product)->toArray(); // Transform data
    }


    public function  getProductByCategoryId(Request $request){
        try{
            $id = $request->id;
            $products = Product::with(['categories','attributes_values'])->whereHas('categories',function($query) use ($id){
                $query->where('category_id',$id);
            })->get();
            if($products){
                foreach($products as $product){
                    $attribute = [];
                    foreach($product->attributes_values as $attr){
                        $attribute[] = $attr->value;
                    }
                }
                $product->attr = $attribute;
                $products = $this->formatProductData($products);
                return $this->success($products, "List Product");
            }



        }
        catch(\ Exception $e){
            return $this->error($e);
        }
    }

    public function searchProduct(Request $request){
        try{
            $size = $request->get('size');
            $color = $request->get('color');

            $products = Product::with('attributes_values')
                ->whereHas('attributes_values',function($query) use($size){
                    $query->where('value',$size);
                })
                ->whereHas('attributes_values',function($query) use($color) {
                    $query->where('value', $color);
                })
                ->get();

            $products = $this->formatProductData($products);

            return $this->success($products, "List Product");
        }
        catch(\ Exception $e){
            return $this->error($e);
        }
    }
}

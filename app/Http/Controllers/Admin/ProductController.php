<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getListProduct(){

        $products = Product::with('attributes_values')->get();

        return view('admin.product.list',compact('products'));
    }

    public function addProduct(){
        $cates = Category::all();
        $sizes = AttributeValue::where('attribute_id',1)->get();
        $colors = AttributeValue::where('attribute_id',2)->get();
        return view('admin.product.add',compact('cates','sizes','colors'));
    }

    public function postAddProduct(Request $request){
        $title = $request->get('title');
        $price = $request->get('price');
        $desc = $request->get('desc');
        $content = $request->get('content');
        $categories_id = $request->get('categories_id');
        $sizes = $request->get('size');
        $colors = $request->get('color');


        $product  = Product::create([
           'title' => $title,
           'price' => $price,
           'desc' => $desc,
           'content' => $content,
            'admin_id' => Auth::guard('admin')->id(),
        ]);
        if($product){
            if($request->hasFile('images')){
                $product->addAllMediaFromRequest('images')->each(function($file){
                   $file->toMediaCollection('Photos of the product ');
                });
             }
             foreach($sizes as $size){
                 $product->attributes_values()->attach($size);
             }
            foreach($colors as $color){
                $product->attributes_values()->attach($color);
            }
            foreach($categories_id as $cate_id){
                $product->categories()->attach($cate_id);
            }

            return redirect()->back()->with('success','Add new product success');

        }

    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->attributes_values()->detach();
        $product->categories()->detach();
        $product->delete();
        return redirect()->back()->with('success','Delete product success');
    }

    public function editProduct($id){
        $cates = Category::all();
        $product = Product::whereId($id)->with(['categories','attributes_values'])->first();
        $cates_product_id = $product->categories->pluck('id')->toArray();
        $sizes = AttributeValue::where('attribute_id',1)->get();
        $sizes_product_id = $product->attributes_values->where('attribute_id',1)->pluck('id')->toArray();
        $colors_product_id = $product->attributes_values->where('attribute_id',2)->pluck('id')->toArray();
        $colors = AttributeValue::where('attribute_id',2)->get();

        return view('admin.product.edit',compact('product','cates','sizes','colors','cates_product_id','sizes_product_id','colors_product_id'));
    }
    public function postEditProduct(EditProductRequest $request, $id){
        $title = $request->get('title');
        $price = $request->get('price');
        $desc = $request->get('desc');
        $content = $request->get('content');

        $product = Product::find($id)->update([
            'title' => $title,
            'price' => $price,
            'desc' => $desc,
            'content' => $content,
            'admin_id' => Auth::guard('admin')->id(),
        ]);
        $new_product = Product::find($id);
        if($new_product){
            if($request->hasFile('images')){
                $new_product->addAllMediaFromRequest('images')->each(function($file){
                    $file->toMediaCollection('Photos of the product ');
                });
            }
            if($request->has('size')){
                foreach($new_product->attributes_values->where('attribute_id',1) as $item){
                    $new_product->attributes_values()->detach($item);
                }
                $new_product->attributes_values()->attach($request->get('size'));

            }
            if($request->has('color')){
                foreach($new_product->attributes_values->where('attribute_id',2) as $item){
                    $new_product->attributes_values()->detach($item);
                }
                $new_product->attributes_values()->attach($request->get('color'));

            }

            if($request->get('categories_id')){
                $new_product->categories()->sync($request->get('categories_id'));
            }


            return redirect()->route('product.index')->with('success','Update product success');

        }
    }


}

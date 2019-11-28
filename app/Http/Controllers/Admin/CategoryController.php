<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddcategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Validator;
class CategoryController extends Controller
{
    public function getListCategory()
    {
        $cates = Category::all();
        $parents = Category::all();
        return view('admin.category.list', compact('cates', 'parents'));
    }

    public function addCategory()
    {
        $parents = Category::select('id', 'title', 'parent_id')->get();
        return view('admin.category.add', compact('parents'));
    }

    public function postAddCategory(AddcategoryRequest $request)
    {
        $title = $request->get('title');
        $parent_id = $request->get('parent_id');
        Category::create([
            'title' => $title,
            'parent_id' => $parent_id,
        ]);
        return redirect()->back()->with('success', 'Add new category success');
    }

    public function editCategory($id)
    {
        $cate = Category::find($id);
        $parents = Category::all();
        return view('admin.category.edit', compact('cate', 'parents'));
    }

    public function postEditCategory(Request $request, $id)
    {

        $cate = Category::find($id)->update([
            'title' => $request->get('title'),
            'parent_id' => $request->get('parent_id'),
        ]);
        return redirect()->route('category.index')->with('success','Edit category success');
    }
    public function deleteCategory($id){
        $cates = Category::all();
        $cate = Category::find($id)->with('products')->first();
        foreach($cates as $item){
            if($id == $item->parent_id){
                return  redirect()->back()->with('error','Cannot delete category parent !!');
            }
        }
        $products = $cate->products()->get();
        if($products->isNotEmpty()){
            return redirect()->back()->with('error','Cannot delete category because product in the catalog exists');
        }

        $cate->delete();
        return redirect()->route('category.index')->with('success', ' Delete category success');

    }

}

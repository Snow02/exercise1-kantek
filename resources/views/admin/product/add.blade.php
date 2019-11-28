
@extends('admin.master')
@section('title','Product Add')
@section('admin')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if (session('success'))
                        <p class="success">{{session('success')}}</p>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label>Category Parent</label>

                        <select class="form-control js-example-basic-multiple" name="categories_id[]" multiple>
                            <option value="">Please Choose Category</option>

                            @foreach ($cates as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('categories_id'))
                        <p class="error">{{ $errors->first('categories_id') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="title" placeholder="Please Enter Username" value="{{ old('title') }}"/>
                        @if ($errors->has('title'))
                        <p class="error">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-control" name="price" placeholder="Please Enter Password" value="{{ old('price') }}"/>
                        @if ($errors->has('price'))
                        <p class="error">{{ $errors->first('price') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class=" ckeditor form-control" rows="3" name="desc" >{{ old('desc') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class=" ckeditor form-control" rows="3" name="content">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <p class="error">{{ $errors->first('content') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Size</label>
                        <div class="form-check">
                            @foreach ($sizes as $item)
                                <input  class="form-check-input" name="size[]" type="checkbox" id="" value="{{$item->id}}">
                                <label class="form-check-label" for="">{{$item->value}}</label>
                            @endforeach

                        </div>
                        @if ($errors->has('size'))
                            <p class="error">{{ $errors->first('size') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <div class="form-check">
                            @foreach ($colors as $item)
                                <input  class="form-check-input" name="color[]" type="checkbox" id="" value="{{$item->id}}">
                                <label class="form-check-label" for="">{{$item->value}}</label>
                            @endforeach


                        </div>
                        @if ($errors->has('color'))
                            <p class="error">{{ $errors->first('color') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Images</label>
                        <input type="file" name="images" multiple>
                        @if ($errors->has('images'))
                            <p class="error">{{ $errors->first('images') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-default">Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>


            </form>
        </div>
             <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
     </div>
     <!-- /#page-wrapper -->

 </div>
 <!-- /#wrapper -->

 @endsection

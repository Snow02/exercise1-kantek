@extends('admin.master')
@section('title','Category Edit')
@section('admin')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (session('edit'))
                    <p class="success">{{ session('edit') }}</p>
                @endif
                <form action="{{ route('category.edit',$cate->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="id" value="{{ $cate->id }}">

                    <div class="form-group">
                        <label>Category Parent</label>
                        <select class="form-control" name="parent_id">
                            <option value="">Please Choose Category</option>
                            @foreach ($parents as $item)
                                <option value="{{ $item->id }}" <?php if($item->id == $cate->parent_id) echo "selected='selected'"; ?>>{{ $item->title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control" name="title" placeholder="Please Enter Category Name" value="{{ $cate->title }}"/>
                        @if ($errors->has('title'))
                            <p class="error">{{ $errors->first('title') }}</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection

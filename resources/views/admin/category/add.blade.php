@extends('admin.master')
@section('title','Category Add')
@section('admin')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (session('success'))
                    <p class="success">--------{{ session('success') }}--------</p>
                 @endif
                <form action="{{ route('category.add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Category Parent</label>
                        <select class="form-control" name="parent_id">
                            <option value="">Please Choose Category</option>
                            @foreach ($parents as $parent)
                                <option value="{{$parent->id}}">{{$parent->title}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control" name="title" placeholder="Please enter category name" />
                        @if ($errors->has('title'))
                            <p class="error">----------{{ $errors->first('title') }}---------</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-default">Category Add</button>
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

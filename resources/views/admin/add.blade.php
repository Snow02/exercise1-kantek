@extends('admin.master')
@section('title','Add User')
@section('admin')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Admin
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (session('success'))
                    <p class="success">{{session('success')}}</p>
                @endif
                <form action="{{route('admin.register')}}" enctype="multipart/form-data"  id="form-add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Fullname</label>
                        <input class="form-control" name="name" id="name" placeholder="Please Enter Name" value="{{ old('name') }}" />
                        @if ($errors->has('name'))
                            <p class="error">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="username" id="username" placeholder="Please Enter Username" value="{{ old('username') }}" />
                        @if ($errors->has('username'))
                            <p class="error">{{ $errors->first('username') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" id="email" placeholder="Please Enter Email" value="{{ old('email') }}" />
                        @if ($errors->has('email'))
                            <p class="error">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Please Enter Password" />
                        @if ($errors->has('password'))
                            <p class="error">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-default" id="btn-add">Add</button>
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

@extends('admin.master')
@section('title','List Admin')
@section('admin')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>

                    <tr align="center">
                        <th>STT</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $temp = 0; ?>
                    @foreach ($admins as $item)
                    <?php $temp++; ?>
                        <tr class="odd gradeX" align="center">
                            <td>{{ $temp }}</td>
                            <td><b>{{ $item->username }}</b></td>
                            <td><b>{{ $item->name }}</b></td>
                            <td>{{ $item->email }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <form action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-delete" name="btn-delete" onclick="return confirm_delete('Bạn có muốn xóa không??')">Delete</button>
                                </form>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="">Edit</a></td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

    @endsection

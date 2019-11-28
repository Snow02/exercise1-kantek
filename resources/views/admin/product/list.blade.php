@extends('admin.master');
@section('title','List Product')
@section('admin')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>List</small>
                </h1>
            </div>
            @if (session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $temp = 0; ?>
                    @foreach ($products as $item)
                        <?php $temp++ ?>
                        <tr class="odd gradeX" align="center">
                            <td>{{ $temp }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ number_format($item->price,0,',','.') }} $</td>
                            <td>
                                @foreach ($item->attributes_values->where('attribute_id',1) as $size)
                                    {{$size->value}}-
                                @endforeach
                            </td>
                            <td>
                                @foreach ($item->attributes_values->where('attribute_id',2) as $color)
                                    {{$color->value}}-
                                @endforeach
                            </td>
                            <td>
                                @foreach ($item->categories as $cate)
                                    {{$cate->title}}-
                                @endforeach

                            </td>
                            <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}  </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <form action="{{route('product.delete',$item->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-delete" name="btn-delete" onclick="return confirm_delete('Bạn có muốn xóa không??')">Delete</button>
                                </form>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw fl-left"></i> <a href="{{route('product.edit',$item->id)}}">Edit</a></td>
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

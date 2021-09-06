@extends('layouts.master')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection()
@section('contents')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>สินค้าของฉัน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">สินค้าของฉัน</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            
            @if(session("success"))
            <div class="col-12">
                <div class="alert alert-success">{{session('success')}}</div>
            </div>
            @endif
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">รายการสินค้าของฉัน</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ลำดับ.</th>
                            <th>กลุ่มสินค้า</th>
                            <th>Code.</th>
                            <th>ชื่อสินค้า</th>
                            <th>รายละเอียด</th>
                            <th>ขนาด</th>
                            <th>ราคา</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class=>
                            @php($i=1)
                            @foreach($product as $key => $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    {{$value->product_group->name}}
                                </td>
                                <td>
                                    {{$value->code}}
                                </td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->size}}</td>
                                <td>{{$value->price}}</td>
                                <td>
                                    <a href="{{url('/')}}/product/{{$value->id}}" class="btn btn-warning">Edit</a>
                                    <form action="{{url('/')}}/product/delete/{{$value->id}}" method="post">@csrf
                                        <button class="btn btn-danger"  type="submit">delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="7"> <h1 align="right">จำนวนรายการ:</h1></th>
                            <th>{{count($product)}}</th>
                        </tr>
                        </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                </div>

            <div class="col-4">
                <div class="card card-solid">
                    <div class="card-header">
                        เพิ่มรายการสินค้า
                    </div>
                    <div class="card-body pb-0" >
                        <form action="{{url('/')}}/product" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>สินค้าจัดอยู่ในกลุ่ม</label>
                                            <select class="form-control" name="product_group_id">
                                                @foreach($product_group as $key => $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>รหัสสินค้า:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name='code' class="form-control input-code">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">สุ่มรหัสสินค้า</span>
                                                </div>
                                            </div>
                                            @error('code')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ชื่อสินค้า:</label>
                                            <input type="text" class="form-control" name="name" maxlength="30" required>
                                            @error('name')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>รายละเอียดสินค้า:</label>
                                            <input type="text" class="form-control" name="description" maxlength="30" required>
                                            @error('description')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ขนาดของสินค้า:</label>
                                            <input type="text" class="form-control" name="size" maxlength="30" required>
                                            @error('size')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ราคาของสินค้า:</label>
                                            <input type="number" class="form-control" name="price" step="0.01" required>
                                            @error('price')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="form-control btn btn-primary" >เพิ่มรายการ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{url('/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('/')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{url('/')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('/')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('/')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('/')}}dist/js/demo.js"></script>     
<!-- InputMask -->
<script src="{{asset('/')}}plugins/moment/moment.min.js"></script>
<script src="{{asset('/')}}plugins/inputmask/jquery.inputmask.min.js"></script>

<script>
  $(function () {
    // bsCustomFileInput.init();
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
  
    //Money Euro
    $('.input-group-append').on('click',function() {
        $('.input-code').val(Date.now());
    })
    $('[data-mask]').inputmask()
</script>
@endsection()
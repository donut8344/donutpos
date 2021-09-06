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
                    <h1>Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Employee</a></li>
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
                        <h3 class="card-title">My Employee List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ลำดับ.</th>
                            <th>User ID</th>
                            <th>ตำแหน่ง</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>เบอร์โทร</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($emp as $key => $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    {{$value->user->name}}
                                </td>
                                <td>{{$value->emp_type->name}}</td>
                                <td>{{$value->fname}} {{$value->lname}}</td>
                                <td>{{$value->phone}}</td>
                                <td>
                                    <a href="{{url('/')}}/emp/{{$value->id}}" class="btn btn-warning">Edit</a>
                                    <form action="{{url('/')}}/emp/delete/{{$value->id}}" method="post">@csrf
                                        <button class="btn btn-danger"  type="submit">delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4"> <h1 align="right">จำนวนรายการ:</h1></th>
                            <th>{{count($emp)}}</th>
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
                        Add New employee
                    </div>
                    <div class="card-body pb-0" >
                        <form action="{{url('/')}}/emp" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>User Name:</label>
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
                                            <div class="form-group">
                                                <label>กลุ่มของผู้ใช้</label>
                                                <select class="form-control" name="employee_type_id" require>
                                                    <option value="4">Admin</option>
                                                    <option value="5">Employee</option>
                                                </select>
                                                @error('employee_type_id')
                                                    <div class="my-2">
                                                        <span class="text-danger">{{$message}}</span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="email" class="form-control" name="email" required>
                                            @error('email')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" name="password" required>
                                            @error('password')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ชื่อ:</label>
                                            <input type="text" class="form-control" name="fname" required>
                                            @error('fname')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>นามสกุล:</label>
                                            <input type="text" class="form-control" name="lname" required>
                                            @error('lname')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>ที่อยู่:</label>
                                            <textarea class="form-control" name="address" rows="3" placeholder="ป้อนที่อยู่ ..."></textarea>
                                            @error('address')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="phone" name="phone" class="form-control"
                                                data-inputmask="'mask': ['999-999-9999']" data-mask>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            @error('phone')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="form-control btn btn-primary" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
@section('js')

<!-- InputMask -->
<script src="{{asset('/')}}plugins/moment/moment.min.js"></script>
<script src="{{asset('/')}}plugins/inputmask/jquery.inputmask.min.js"></script>
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

<script type="text/javascript">
</script>
<script type="text/javascript">

    //Money Euro
    bsCustomFileInput.init();
    $('[data-mask]').inputmask()
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf"]
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
  
</script>

@endsection
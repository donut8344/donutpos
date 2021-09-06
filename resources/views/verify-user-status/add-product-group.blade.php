@extends('verify-user-status.master')
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection()
@section('contents')
    <!-- Main content -->
    
    <form action="{{url('/')}}/add-new-product-group/next" method="post">
        @csrf
        <div class="card card-success m-2">
            <div class="card-header">
                <h3 class="card-title">กลุ่มของสินค้า</h3>
                @if(count($product_group)) 
                <button type="submit" class="btn btn-primary float-right" >ถัดไป</button>
                @endif
            </div>
        </div>
    </form>
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
                        <h3 class="card-title">รายการกลุ่มของสินค้าของฉัน</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ลำดับ.</th>
                            <th>ชื่อกลุ่มสินค้า</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($product_group as $key => $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$value->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="1"> <h1 align="right">จำนวนรายการ:</h1></th>
                            <th>{{count($product_group)}}</th>
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
                        เพิ่มรายการกลุ่มหรือประเภทสินค้า
                    </div>
                    <div class="card-body pb-0" >
                        <form action="{{url('/')}}/add-new-product-group" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>ชื่อกลุ่มสินค้า:</label>
                                            <input type="text" class="form-control" name="name" maxlength="30" required>
                                            @error('name')
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
        "buttons": ["csv", "excel"]
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
    $('.input-group-append').on('click',function(){
        $('.input-code').val(Date.now());
    });
  
</script>
@endsection
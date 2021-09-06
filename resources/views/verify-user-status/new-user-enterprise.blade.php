<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donut POS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/')}}dist/css/adminlte.min.css">
    <style>
        body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) {
            transition: margin-left .3s ease-in-out;
            margin-left: unset;
        }
    </style>
</head>

<body class='hold-transition sidebar-mini'>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 850px;">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row m-2">
                        @if(session("success"))
                        <div class="col-12">
                            <div class="alert alert-success">{{session('success')}}</div>
                        </div>
                        @endif
                        <!-- left column -->
                        <div class="col-md-12 m-2">
                            <!-- general form elements -->
                            <div class="card card-primary m-2" >
                                <div class="card-header">
                                    <h3 class="card-title">สร้างองค์กรของคุณ</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{url('/')}}/new-user-enterprise" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ชื่อองค์กรของคุณ</label>
                                            <input type="text" name="name" class="form-control" placeholder="ป้อนชื่อองค์กร" require>
                                            @error('name')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>ที่อยู่ขององค์กร</label>
                                            <textarea class="form-control" name="address" rows="3" placeholder="ป้อนที่อยู่องค์กร ..."></textarea>
                                            @error('address')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>                                        
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="phone" name="phone" class="form-control"
                                                data-inputmask="'mask': ['999-999-9999']" data-mask>
                                            @error('phone')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer text-rigth float-right">
                                        <button type="submit" class="btn btn-primary">ถัดไป</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('/')}}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('/')}}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('/')}}plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/')}}dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('/')}}dist/js/demo.js"></script>        
    <!-- InputMask -->
    <script src="{{asset('/')}}plugins/moment/moment.min.js"></script>
    <script src="{{asset('/')}}plugins/inputmask/jquery.inputmask.min.js"></script>
    <script>
    $(function() {
        bsCustomFileInput.init();
        
        //Money Euro
        $('[data-mask]').inputmask()
    });
    </script>
</body>

</html>
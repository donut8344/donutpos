@extends('layouts.master')

@section('css')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{asset('/')}}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<style>
.my-custom-scrollbar {
    position: relative;
    height: 320px;
    overflow: auto;
}

.table-wrapper-scroll-y {
    display: block;
    padding: 1px;
}
</style>
@endsection()
@section('contents')

<!-- Content Header (Page header) -->
<section class="content-header pb-0">
    <div class="container-fluid">
        <form action="{{url('/')}}/payment" method="post">@csrf
            <div class="row">
                <div class="col-8">
                    <h1>POS หน้าจอการขาย</h1>
                </div>
                <dov class="col-3">
                    <div class="form-group">
                        <!-- <label>รูปแบบการชำระ</label> -->
                        <select class="form-control" name="payment_type" >
                            @foreach($payment_type as $key => $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </dov>
                <div class="col-1">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <button type="submit" class="btn btn-app bg-info">
                                @if(count($order_control))
                                <span class="badge bg-teal">{{count($order_control)}}</span>
                                @endif
                                <i class="fas fa-inbox"></i> ชำระเงิน
                            </button>
                        </li>
                    </ol>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="content pb-0">
    <div class="container-fluid h-100">
        <div class="row">
            @if(session("invoice_no"))
            <div class="col-12">
                <div class="alert alert-success"> <a href="{{url('/')}}/invoice/{{session('invoice_no')}}">เลขที่ใบแจ้งหนี้:{{session('invoice_no')}}</a></div>
            </div>
            @endif
            <div class="col-5">
                <div class="card">
                    <div class="card-header p-2">
                        <form action="{{url('/')}}/order-control" class="fm-post-pd" method="post">@csrf
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group m-0">
                                        <label>Qty:</label>
                                        <div class="input-group mb-3">
                                            <input type="number" name='qty' value="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group m-0">
                                        <label>รหัสสินค้า:</label>
                                        <div class="input-group mb-3">
                                            <input type="number" name='code' class="form-control input-code" autofocus>
                                            <div class="input-group-append">
                                                <button type="submit" class="input-group-text btn-asdf">ยืนยัน</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>ชื่อ</th>
                                    <th>ราคา</th>
                                    <th>qty.</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($order_control as $key => $value)
                                <tr>
                                    <td>{{$i++}}.</td>
                                    <td>{{$value->product->name}} ({{$value->product->product_group->name}})</td>
                                    <td>{{$value->product->price}}</td>
                                    <td>{{$value->qty}}</td>
                                    <td>
                                        <form action="{{url('/')}}/order-control/{{$value->id}}" method="post">@csrf
                                            <button type="submit" class="btn btn-tool bg-danger"><i
                                                    class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-4">
                                <p>จำนวนรายการ: {{count($order_control)}}</p>
                            </div>
                            <div class="col-4">
                                <p>จำนวนชิ้น: {{$tatal_qty}}</p>
                            </div>
                            <div class="col-4">
                                ราคา: {{$tatal_price}} บาท
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#allmenu"
                                    data-toggle="tab">เมนูทั้งหมด</a></li>
                            @php($i=1)
                            @foreach($product_group as $key => $value)
                            <li class="nav-item"><a class="nav-link tabs-{{$i===1?'active':''}} r-{{$i++}}"
                                    href="#tab{{$value->id}}" data-toggle="tab">{{$value->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="active tab-pane" id="allmenu">
                                <div class="card-body table-responsive p-0" style="height: 415px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>กลุ่ม</th>
                                                <th>ชื่อ</th>
                                                <th>ราคา</th>
                                                <th>สั่งซื้อ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product as $key => $value)
                                            <tr>
                                                <td>{{$value->product_group->name}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>฿ {{$value->price}}.-</td>
                                                <td>
                                                    <input type="hidden" class="pd-id" value="{{$value->id}}">
                                                    <input type="hidden" class="pd-name" value="{{$value->name}}">
                                                    <button type="submit" class="btn btn-primary add-stock"
                                                        data-toggle="modal" data-target="#modal-sm">เพิ่ม</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @php($b=1)
                            @foreach($product_group as $key => $values)
                            <div class="tab-pane" id="tab{{$values->id}}">
                                <div class="card-body table-responsive p-0" style="height: 415px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ชื่อ</th>
                                                <th>ราคา</th>
                                                <th style="width: 20px">สั่งซื้อ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($values['child'] as $key => $value)
                                            <tr>
                                                <td>{{$value->name}}</td>
                                                <td>฿ {{$value->price}}.-</td>
                                                <td>
                                                    <input type="hidden" class="pd-id" value="{{$value->id}}">
                                                    <input type="hidden" class="pd-name" value="{{$value->name}}">
                                                    <button type="submit" class="btn btn-primary add-stock"
                                                        data-toggle="modal" data-target="#modal-sm">เพิ่ม</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                            <!-- /.tab-pane -->
                        </div>
                    </div><!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <form class="form-modal-dialog" action="{{url('/')}}/order-control" method="post">@csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">จำนวนสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="product-name"></h1>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Qty:</label>
                        <input type="hidden" class="form-control products-id" name="products_id">
                        <input type="number" class="form-control in-qty" name="qty" value="1">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">สั่งซื้อ</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection()

@section('js')

<!-- SweetAlert2 -->
<script src="{{asset('/')}}plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    $('.input-code').on('keyup',function(e){
        if($('.input-code').val().length >= {{$emp->enterprise->product_code_length}}){
            $('.fm-post-pd').submit();
        }
    })
    let data;
    $('.add-stock').on('click', function() {
        data = {
            id: $(this).parent().find('.pd-id').val(),
            name: $(this).parent().find('.pd-name').val(),
        };
    });
    $('#modal-sm').on('show.bs.modal', function(event) {
        $(this).find('.product-name').text(data.name);
        $(this).find('.products-id').val(data.id);
        $(this).find('.in-qty').focus();
    })
</script>
@endsection()
@extends('layouts.master')
@section('contents')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขรายการสินค้า</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('products') }}">สินค้า</a></li>
                        <li class="breadcrumb-item active">แก้ไข</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
        
        @if(session("success"))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">{{session('success')}}</div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card card-solid">
                    <div class="card-header">
                        แก้ไขายการสินค้า
                    </div>
                    <div class="card-body pb-0" >
                        <form action="{{url('/')}}/product/{{$product->id}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>สินค้าจัดอยู่ในกลุ่ม</label>
                                            <select class="form-control" name="product_group_id" >
                                                @foreach($product_group as $key => $value)
                                                <option value="{{$value->id}}" {{$product->product_group_id == $value->id?'selected':''}} >{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>รหัสสินค้า: {{$product->code}}</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ชื่อสินค้า:</label>
                                            <input type="text" class="form-control" name="name" maxlength="30" value='{{$product->name}}' required>
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
                                            <input type="text" class="form-control" name="description" maxlength="30" value='{{$product->description}}' required>
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
                                            <input type="text" class="form-control" name="size" maxlength="30" value='{{$product->size}}' required>
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
                                            <input type="number" class="form-control" name="price" step="0.01" value='{{$product->price}}' required>
                                            @error('price')
                                                <div class="my-2">
                                                    <span class="text-danger">{{$message}}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="form-control btn btn-primary" >แก้ไขรายการ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
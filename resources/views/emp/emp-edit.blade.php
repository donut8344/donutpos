@extends('layouts.master')
@section('contents')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Enterprise Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('emp') }}">Enterprise</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
        <div class="card card-solid">
            <div class="card-header">
                แก้ไขข้อมูลพนักงาน
            </div>
            <div class="card-body pb-0" >
                <form action="{{url('/')}}/emp/{{$emp->id}}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ชื่อ:</label>
                                    <input type="text" class="form-control" name="fname" value="{{$emp->fname}}" required>
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
                                    <input type="text" class="form-control" name="lname" value="{{$emp->lname}}" required>
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
                                    <textarea class="form-control" name="address" rows="3" placeholder="ป้อนที่อยู่ ..." >{{$emp->address}}</textarea>
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
                                    <input type="phone" name="phone" class="form-control" value="{{$emp->phone}}"
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
    </section>
@endsection()
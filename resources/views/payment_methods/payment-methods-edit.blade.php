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
                        <li class="breadcrumb-item"><a href="{{ route('enterprise') }}">Enterprise</a></li>
                        <!-- <li class="breadcrumb-item"><a href="{{url('/')}}/enterprise/edit">Payment Methods</a></li> -->
                        <li class="breadcrumb-item active">Edit</li>
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

            <div class="col-12">
                <div class="card card-solid">
                    <div class="card-header">
                        Update my Payment
                    </div>
                    <div class="card-body pb-0" >
                        <form action="{{url('/')}}/payment-methods/update/{{$payment_methods->id}}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" maxlength="30" required value="{{$payment_methods->name}}">
                                @error('name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <label>desc:</label>
                                <textarea type="text" class="form-control" name="desc" required>{{$payment_methods->desc}}</textarea>
                                @error('desc')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <label>status</label>
                                <input type="text" class="form-control" name="status" maxlength="30" required value="{{$payment_methods->status}}">
                                @error('status')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    <br>
                                @enderror
                                <br/>
                                <button type="submit" class="form-control btn btn-primary" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
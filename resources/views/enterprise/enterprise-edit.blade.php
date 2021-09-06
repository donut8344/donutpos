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
                        Update my Enterprise <h2 align="right">Enterprise Code: {{$enterprise->enterprise_code}}</h2>
                    </div>
                    <div class="card-body pb-0" >
                        <form action="{{url('/')}}/enterprise/update/{{$enterprise->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" maxlength="30" required value="{{$enterprise->name}}">
                                @error('name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <label>Address:</label>
                                <textarea type="text" class="form-control" name="address" required>{{$enterprise->address}}</textarea>
                                @error('address')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <label>phone</label>
                                <input type="phone" class="form-control" name="phone" maxlength="30" required value="{{$enterprise->phone}}">
                                @error('phone')
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
            
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment Methods List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>payment_methods Name</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($payment_methods as $key => $value)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->desc}}</td>
                                <td> {{$value->status}}</td>
                                <td>
                                    <a href="{{url('/')}}/payment-methods/edit/{{$value->id}}" class="btn btn-warning">Edit</a>
                                    <form action="{{url('/')}}/payment-methods/delete/{{$value->id}}" method="post">@csrf
                                        <button class="btn btn-danger"  type="submit">delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4"> <h1 align="right">Total list:</h1></th>
                            <th>{{count($payment_methods)}}</th>
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
                        Create My Payment methods
                    </div>
                    <div class="card-body pb-0" >
                        <form action="{{url('/')}}/payment-methods/{{$enterprise->id}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" maxlength="30" required>
                                @error('name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <label>Description:</label>
                                <textarea type="text" class="form-control" name="description" required></textarea>
                                @error('description')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
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
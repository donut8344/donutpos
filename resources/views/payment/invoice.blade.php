@extends('layouts.master')

@section('css')
@endsection()
@section('contents')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ใบแจ้งหนี้</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ใบแจ้งหนี้</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <b>{{$invoice->enterprise->name}}</b>
                    <small class="float-right">Date: {{Date('d/m/Y')}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <!-- <strong>Admin, Inc.</strong><br> -->
                    {{$invoice->enterprise->address}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <!-- <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address> -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{$invoice->order->invoice_no}}</b><br>
                  <br>
                  <b>Payment Due:</b> {{date_format(date_create($invoice->order->updated_at),'d/m/Y H:i:s')}}<br>
                  <!-- <b>Account:</b> 968-34567 -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @php($i=1)
                      @foreach($invoice->list as $key => $value)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->code}}</td>
                        <td>{{$value->description}}</td>
                        <td>{{$value->price}}.-</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods: {{$invoice->payment_type->name}}</p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due {{date_format(date_create($invoice->order->updated_at),'d/m/Y H:i:s')}}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{$invoice->order->total_price}}</td>
                      </tr>
                      @if($invoice->order->tax > 0)
                      <tr>
                        <th>Tax ({{$invoice->order->tax}}%)</th>
                        <td>$10.34</td>
                      </tr>
                      @endif
                      @if($invoice->order->vat > 0)
                      <tr>
                        <th>Vat ({{$invoice->order->tax}}%)</th>
                        <td>$10.34</td>
                      </tr>
                      @endif
                      <tr>
                        <th>Total:</th>
                        <td>฿{{$invoice->order->total_price}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{url('/')}}/invoice-print/{{$invoice->order->invoice_no}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection()

@section('js')
@endsection()
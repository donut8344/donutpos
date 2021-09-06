<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/')}}plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/')}}dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> {{$invoice->enterprise->name}}
          <small class="float-right">{{Date('d/m/Y')}}</small>
        </h2>
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
        </address> -->
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #{{$invoice->order->invoice_no}}</b><br>
        <br>
        <!-- <b>Order ID:</b> 4F3S8J<br> -->
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
            <?php foreach($invoice->list as $key => $value){ ?>
            <tr>
              <td>{{$i++}}</td>
              <td>{{$value->name}}</td>
              <td>{{$value->code}}</td>
              <td>{{$value->description}}</td>
              <td>{{$value->price}}.-</td>
            </tr>
            <?php } ?>
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
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Emp;
use App\Models\Product;
use App\Models\OrderControl;
use App\Models\Enterprise;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\SaleWarehouse;
use App\Models\Invoice;
use App\Models\PaymentType;

class PaymentControlController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    
    public function invoice(Request $request,$id){
        $invoice = json_decode(Invoice::where('invoice_no',$id)->first()->detail);
        // dd($invoice);
        return view('payment.invoice',compact('invoice'));
    }
    
    public function print(Request $request,$id){
        $invoice = json_decode(Invoice::where('invoice_no',$id)->first()->detail);
        return view('payment.print',compact('invoice'));
    }
    
    
    public function store(Request $request){
        $request->validate(
            [
                'payment_type'=>'required|integer',
            ]
        );

        $data = [];
        $invoice_no = Auth::user()->id.Date('YmdHis');
        $emp = Emp::where('user_id',Auth::user()->id)->first();
        $data['enterprise'] = Enterprise::find($emp->enterprise_id);
        $data['payment_type'] = PaymentType::find($request->payment_type);


        if(!OrderControl::where('employee_id',$emp->id)->exists()){
            return redirect()->back();
        }
        $data['list'] = OrderControl::where('employee_id',$emp->id)
        ->joinSub(Product::tosql(), 'p', function ($join) {
            $join->on('order_controls.products_id', '=', 'p.id');
        })
        ->get();
        
        $tatal_qty = 0;
        $tatal_price = 0;
        foreach ($data['list'] as $key => $value) {
            $tatal_qty += $value->qty;
            $tatal_price += ($value->price * $value->qty);
        }
        $data_order = [
            'invoice_no' => $invoice_no
            ,'enterprise_id' => $emp->enterprise_id
            ,'employee_id' => $emp->id
            ,'total_price' => $tatal_price
            ,'tax' => 0
            ,'vat' => 0
            ,'payment_type_id' => $request->payment_type
        ];
        // if (@$request->consumers_id->exists()) {
        //     $data_order['consumers_id'] = $request->consumers_id;
        // }
        $data['order'] = Order::create($data_order);

        foreach ($data['list'] as $key => $value) {
            $s =SaleWarehouse::where('enterprise_id',$emp->enterprise_id)
            ->where('product_id',$value->products_id)
            ->where('year',Date('Y'));
            if($s->exists()){
                $saleWarehouse = SaleWarehouse::find($s->first()->id)->update([
                    'qty' => $value->qty + $s->first()->qty
                ]);
            }else{
                SaleWarehouse::create([
                    'enterprise_id' => $emp->enterprise_id
                    ,'product_id' => $value->products_id
                    ,'year' => Date('Y')
                    ,'qty' => $value->qty
                ]);
            }
            OrderDetail::create([
                'order_id' => $data['order']->id
                ,'products_id' => $value->products_id
                ,'qty' => $value->qty
            ]);
        }
        $Invoice = Invoice::create([
            'invoice_no' => $invoice_no
            ,'detail' => json_encode($data)
        ]);
        OrderControl::where('employee_id',$emp->id)->delete();
        return redirect()->back()->with('invoice_no',$invoice_no);
    }
}

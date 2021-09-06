<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Emp;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\OrderControl;
use App\Models\PaymentType;
use DB;

class OrderControlController extends Controller
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
    public function index(Request $request){
        $emp = Emp::where('user_id',Auth::user()->id)->first();
        $group = ProductGroup::where('enterprise_id',$emp->enterprise_id)->get();
        $product_group = [];
        foreach ($group as $key => $value) {
            $product_group[$key] = $value;
            $product_group[$key]['child'] = Product::where('product_group_id',$value->id)->get();
        }
        $product = Product::where('enterprise_id',$emp->enterprise_id)->get();
        $order_control = OrderControl::where('employee_id',$emp->id)->get();
        $tatal_qty = 0;
        $tatal_price = 0;
        foreach ($order_control as $key => $value) {
            $tatal_qty += $value->qty;
            $tatal_price += ($value->product->price * $value->qty);
        }
        
        
        $payment_type = PaymentType::where('enterprise_id',$emp->enterprise_id)->get();
        return view('order-control.order-control',compact('product','product_group','emp','order_control','tatal_qty','tatal_price','payment_type'));
    }
    
    public function store(Request $request){
        $request->validate(
            [
                'products_code'=>'max:50',
                'products_id'=>'max:50',
                'qty'=>'required|max:40',
            ]
        );
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $data = $request->all();
        if(!$request->products_id){ #กรณีไม่มี products_id ค้นหาผ่าน code
            $product = Product::where('enterprise_id',$que->enterprise_id)
            ->where('code',$request->code);
            if($product->exists()){
                $data['products_id'] = $product->first()->id;
            }else{
                return redirect()->back();
            }
            
        }
        $data['employee_id'] = $que->id;
        OrderControl::create($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
    
    public function delete($id){
        OrderControl::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Emp;
use App\Models\PaymentType;

class PaymentTypeController extends Controller
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
        $que = Emp::where('user_id',Auth::user()->id)->first();

        $payment_type = PaymentType::where('enterprise_id',$que->enterprise_id)->get();
        return view('payment-type.payment-type',compact('payment_type'));
    }
    
    public function store(Request $request){
        $request->validate(
            [
                'name'=>'required|max:30',
                'description'=>'max:255',
            ]
        );
        
        $data = $request->all();
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $data['enterprise_id'] = $que->enterprise_id;
        PaymentType::create($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    public function view($id){
        $payment_type = PaymentType::find($id);        
        return view('payment-type.payment-type-edit',compact('payment_type'));
    }
    
    public function update(Request $request , $id){
        $request->validate(
            [
                'name'=>'required|max:30',
                'description'=>'max:255',
            ]
        );
        PaymentType::find($id)->update($request->all());
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        
    }
    
    public function delete($id){
        PaymentType::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}

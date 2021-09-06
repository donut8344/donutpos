<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethods;

class PaymentMethodsController extends Controller
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
    
    public function store(Request $request,$enterprise_id){
        
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name'=>'required|unique:payment_methods|max:30',
                'description'=>'required|max:255',
            ],
            [
                'name.required'=>"กรุณาป้อนชื่อ Payment Methods ด้วยครับ",
                'name.max' => "ห้ามป้อนเกิน 30 ตัวอักษร",
                'name.unique'=>"มีข้อมูลชื่อ Payment Methods นี้ในฐานข้อมูลแล้ว",
                'description.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            ]
        );
        try {
            $data = $request->all();
            $data['enterprise_id'] =  $enterprise_id;
            $data['desc'] =  $request->description;
            PaymentMethods::create($data);
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }

    public function edit($id){
        $payment_methods = PaymentMethods::find($id);
        return view('payment_methods.payment-methods-edit',compact('payment_methods'));
    }

    public function update(Request $request , $id){
        //ตรวจสอบข้อมูล
        
        $request->validate(
            [
                'name'=>'required|max:30',
            ],
            [
                'name.required'=>"กรุณาป้อนชื่อ Payment Methods ด้วยครับ",
                'name.max' => "ห้ามป้อนเกิน 30 ตัวอักษร",
            ]
        );
        if(PaymentMethods::where('name',$request->name)->where('id','!==',$id)->exists()){
           return redirect()->back()->with('error',"มีข้อมูลชื่อ Payment Methods นี้ในฐานข้อมูลแล้ว");
        }
        PaymentMethods::find($id)->update($request->all());
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        
    }
    
    public function delete($id){
        $delete = PaymentMethods::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }

}

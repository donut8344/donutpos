<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enterprise;
use App\Models\PaymentMethods;

class EnterpriseController extends Controller
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
        $enterprise = Enterprise::all();
        return view('enterprise.enterprise',compact('enterprise'));
    }
    
    public function store(Request $request){
        
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name'=>'required|unique:enterprise|max:30',
                'address'=>'required|max:255',
                'phone'=>'required|max:10'
            ],
            [
                'name.required'=>"กรุณาป้อนชื่อ Enterprise ด้วยครับ",
                'name.max' => "ห้ามป้อนเกิน 30 ตัวอักษร",
                'name.unique'=>"มีข้อมูลชื่อ Enterprise นี้ในฐานข้อมูลแล้ว",
                'address.required'=>"กรุณาป้อนเนื้อหาด้วยครับ",
                'phone.required'=>"กรุณาป้อนชื่อเบอร์โทรด้วยครับ",
                'phone.max' => "ห้ามป้อนเกิน 10 ตัวอักษร",
            ]
        );
        try {
            $data = $request->all();
            $data['enterprise_code'] =  date('siHdmY');
            Enterprise::create($data);
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }

    public function edit($id){
        $enterprise = Enterprise::find($id);
        $payment_methods = PaymentMethods::where('enterprise_id',$id)->get();
        
        return view('enterprise.enterprise-edit',compact('enterprise','payment_methods'));
    }

    public function update(Request $request , $id){
        //ตรวจสอบข้อมูล
        
        $request->validate(
            [
                'name'=>'required|max:30',
                'address'=>'required|max:255',
                'phone'=>'required|max:10'
            ],
            [
                'name.required'=>"กรุณาป้อนชื่อ Enterprise ด้วยครับ",
                'name.max' => "ห้ามป้อนเกิน 30 ตัวอักษร",
                'address.required'=>"กรุณาป้อนเนื้อหาด้วยครับ",
                'phone.required'=>"กรุณาป้อนชื่อ Enterprise ด้วยครับ",
                'phone.max' => "ห้ามป้อนเกิน 10 ตัวอักษร",
            ]
        );

        if(Enterprise::where('name',$request->name)->where('id','!==',$id)->exists()){
           return redirect()->back()->with('error',"มีข้อมูลชื่อ Enterprise นี้ในฐานข้อมูลแล้ว");
        }
        Enterprise::find($id)->update($request->all());
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        
    }
    
    public function delete($id){
        $delete = Enterprise::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }

}

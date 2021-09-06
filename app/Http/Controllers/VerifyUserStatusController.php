<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Enterprise;
use App\Models\User;
use App\Models\Emp;
use App\Models\Product;
use App\Models\PaymentType;
use App\Models\ProductGroup;

class VerifyUserStatusController extends Controller
{
    
    public function buySystem(Request $request){
        if (Auth::user()->status <> 1) {
            return redirect('/dashboard');
        }
        return view('verify-user-status.buy-system');
    }
    
    public function paymentSystem(Request $request){
        return view('verify-user-status.payment-system');
    }

    public function paymentSystemStore(Request $request){
        $d=strtotime("+1 Months");
        $user = User::find(Auth::user()->id);
        $user->free_demo = date("Y-m-d", $d);
        $user->status = 2;
        $user->save();
        return redirect('/dashboard');
    }

    public function getDemoSystem(Request $request){
        $d=strtotime("+3 Months");
        $user = User::find(Auth::user()->id);
        $user->free_demo = date("Y-m-d", $d);
        $user->status = 2;
        $user->save();
        return redirect('/dashboard');
    }
    
    public function enterprise(Request $request){
        if (Auth::user()->status <> 2) {
            return redirect('/dashboard');
        }
        return view('verify-user-status.new-user-enterprise');
    }

    public function enterpriseStore(Request $request){
        $request->validate(
            [
                'name'=>'required|unique:enterprise|max:30',
                'phone'=>'max:14'
            ],
            [
                'name.required'=>"กรุณาป้อนชื่อองค์กรด้วยครับ",
                'name.max' => "ห้ามป้อนเกิน 30 ตัวอักษร",
                'name.unique'=>"มีข้อมูลชื่อองค์กรนี้ในฐานข้อมูลแล้ว",
                'phone.max' => "ห้ามป้อนเกิน 14 ตัวอักษร",
            ]
        );

        try {
            $data = $request->all();
            $data['enterprise_code'] =  date('siHdmY');
            $data['create_by_user'] = Auth::user()->id;
            Enterprise::create($data);
            
            $user = User::find(Auth::user()->id);
            $user->status = 3;
            $user->save();
            return redirect('/new-user-employee');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }

    public function employee(Request $request){
        if (Auth::user()->status <> 3) {
            return redirect('/dashboard');
        }
        return view('verify-user-status.new-user-employee');
    }

    public function employeeStore(Request $request){
        $request->validate(
            [
                'fname'=>'required|max:30',
                'lname'=>'required|max:30',
                'address'=>'max:255',
                'phone'=>'max:14'
            ],
            [
                'fname.required'=>"กรุณาป้อนชื่อองค์กรด้วยครับ",
                'fname.max' => "ห้ามป้อนเกิน 30 ตัวอักษร",
                'lname.required'=>"กรุณาป้อนชื่อองค์กรด้วยครับ",
                'lname.max' => "ห้ามป้อนเกิน 30 ตัวอักษร",
                'phone.required'=>"กรุณาป้อนเบอร์โทรด้วยครับ",
                'phone.max' => "ห้ามป้อนเกิน 14 ตัวอักษร",
            ]
        );
        try {
            $data = $request->all();
            $data['employee_type_id'] =  3;
            $data['user_id'] =  Auth::user()->id;
            $data['enterprise_id'] = Enterprise::where('create_by_user',Auth::user()->id)->first()->id;
            Emp::create($data);
            
            $user = User::find(Auth::user()->id);
            $user->status = 4;
            $user->save();
            return redirect('/dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }
    
    public function newUserEmployeeChild(Request $request){
        if (Auth::user()->status <> 4) {
            return redirect('/dashboard');
        }
        
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $emp = Emp::where('enterprise_id',$que->enterprise_id)
        ->where('employee_type_id','>',3)
        ->get();
        return view('verify-user-status.new-user-employee-child',compact('emp'));
    }
    
    public function newUserEmployeeChildNext(Request $request){
        try {
            $user = User::find(Auth::user()->id);
            $user->status = 5;
            $user->save();
            return redirect('/dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }
    
    public function addNewProductGroup(Request $request){
        if (Auth::user()->status <> 5) {
            return redirect('/dashboard');
        }
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $product_group = ProductGroup::where('enterprise_id',$que->enterprise_id)->get();
        return view('verify-user-status.add-product-group',compact('product_group'));
    }
    
    public function addNewProductGroupNext(Request $request){
        try {
            $user = User::find(Auth::user()->id);
            $user->status = 6;
            $user->save();
            return redirect('/dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }
    
    public function addNewProduct(Request $request){
        if (Auth::user()->status <> 6) {
            return redirect('/dashboard');
        }
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $product_group = ProductGroup::where('enterprise_id',$que->enterprise_id)->get();
        $product = Product::where('enterprise_id',$que->enterprise_id)->get();
        return view('verify-user-status.add-product',compact('product','product_group'));
    }
    
    public function addNewProductNext(Request $request){
        try {
            $user = User::find(Auth::user()->id);
            $user->status = 7;
            $user->save();
            return redirect('/dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }
    
    public function createTypePayment(Request $request){
        if (Auth::user()->status <> 7) {
            return redirect('/dashboard');
        }
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $payment_type = PaymentType::where('enterprise_id',$que->enterprise_id)->get();
        return view('verify-user-status.payment-system',compact('payment_type'));
    }

    public function createTypePaymentNext(Request $request){
        try {
            $user = User::find(Auth::user()->id);
            $user->status = 0;
            $user->save();
            return redirect('/dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }
}

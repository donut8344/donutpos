<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Emp;
use App\Models\Enterprise;
use App\Models\User;

class EmpController extends Controller
{
    
    public function index(Request $request){
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $emp = Emp::where('enterprise_id',$que->enterprise_id)
        ->where('employee_type_id','>',3)
        ->get();
        return view('emp.emp',compact('emp'));
    }
    
    public function store(Request $request){
        $request->validate(
            [
                'name'=>'required|max:30',
                'email'=>'required|unique:users|max:30',
                'password'=>'required|min:8|max:30',
                'employee_type_id'=>'required',
                'fname'=>'required|max:30',
                'lname'=>'required|max:30',
                'address'=>'max:255',
                'phone'=>'required|max:14'
            ]
        );

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = 0;
            $user->save();
    
            $emp = new Emp;
            $emp->fname = $request->fname;
            $emp->lname = $request->lname;
            $emp->address = $request->address;
            $emp->phone = $request->phone;
            $emp->employee_type_id = $request->employee_type_id;
            $emp->enterprise_id = Emp::where('user_id',Auth::user()->id)->first()->enterprise_id;
            $emp->user_id = $user->id;
            $emp->save();
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
        } catch (\Throwable $th) {
            dd($request->all());
            return redirect()->back()->with('error',"มีบางอย่างผิดพลาด");
        }
    }

    public function view($id){
        $emp = Emp::find($id);        
        return view('emp.emp-edit',compact('emp'));
    }
    
    public function update(Request $request , $id){
        $request->validate(
            [
                'fname'=>'required|max:30',
                'lname'=>'required|max:30',
                'address'=>'max:255',
                'phone'=>'required|max:14'
            ]
        );
        Emp::find($id)->update($request->all());
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        
    }
    
    public function delete($id){
        $emp = Emp::find($id);
        $user_id = $emp->user_id;
        $emp->delete();
        $delete = User::find($user_id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}

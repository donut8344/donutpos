<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emp;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\Auth;

class ProductGroupController extends Controller
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

        $product_group = ProductGroup::where('enterprise_id',$que->enterprise_id)->get();
        return view('product-group.product-group',compact('product_group'));
    }
    
    public function store(Request $request){
        $request->validate(
            [
                'name'=>'required|max:30',
            ]
        );
        
        $data = $request->all();
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $data['enterprise_id'] = $que->enterprise_id;
        ProductGroup::create($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    public function view($id){
        $product_group = ProductGroup::find($id);        
        return view('product-group.product-group-edit',compact('product_group'));
    }
    
    public function update(Request $request , $id){
        $request->validate(
            [
                'name'=>'required|max:30',
            ]
        );
        ProductGroup::find($id)->update($request->all());
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        
    }
    
    public function delete($id){
        ProductGroup::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}

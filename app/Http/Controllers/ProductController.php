<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enterprise;
use App\Models\Emp;
use App\Models\Product;
use App\Models\ProductGroup;

class ProductController extends Controller
{
    public function __invoke(Request $request)
    {
        //
    }
    
    public function index(Request $request){
        $que = Emp::where('user_id',Auth::user()->id)->first();

        $product_group = ProductGroup::where('enterprise_id',$que->enterprise_id)->get();
        $product = Product::where('enterprise_id',$que->enterprise_id)->get();
        return view('product.product',compact('product','product_group'));
    }
    
    public function store(Request $request){
        $request->validate(
            [
                'code'=>'required|max:20',
                'product_group_id'=>'required|integer|max:20',
                'name'=>'required|max:30',
                'description'=>'max:255',
                'size'=>'required|max:40',
                'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            ]
        );
        
        $data = $request->all();
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $data['enterprise_id'] = $que->enterprise_id;
        Product::create($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    public function view($id){
        $que = Emp::where('user_id',Auth::user()->id)->first();
        $product_group = ProductGroup::where('enterprise_id',$que->enterprise_id)->get();
        $product = Product::find($id);        
        return view('product.product-edit',compact('product','product_group'));
    }
    
    public function update(Request $request , $id){
        $request->validate(
            [
                'name'=>'required|max:30',
                'product_group_id'=>'required|integer|max:20',
                'description'=>'max:255',
                'size'=>'required|max:40',
                'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            ]
        );
        Product::find($id)->update($request->all());
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        
    }
    
    public function delete($id){
        Product::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}

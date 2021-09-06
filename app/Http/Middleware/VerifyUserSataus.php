<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyUserSataus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();            
            if(!strtotime($user->free_demo) || (strtotime($user->free_demo) > strtotime(date('Y-m-d')))){
                switch ($user->status) {
                    case 1: #ลงทะเบียนซื้อระบบ
                        return redirect('/buy-system');
                        break;
                    case 2: #สร้างบริษัท
                        return redirect('/new-user-enterprise');
                        break;
                    case 3: #สร้างข้อมูลส่วนตัว
                        return redirect('/new-user-employee'); 
                        break;
                    case 4: #สร้างข้อมูลผนักงาน
                        return redirect('/new-user-employee-child');
                        break;
                    case 5: #สร้างสินค้า
                        return redirect('/add-new-product-group');
                        break;
                    case 6: #สร้างสินค้า
                        return redirect('/add-new-product');
                        break;
                    case 7: #สร้างรูปแบบการชำระเงิน
                        return redirect('/create-type-payment');
                        break;
                }
            }else{
                return redirect('/payment-system');
            }
        }
        return $next($request);
        
    }
}

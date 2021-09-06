<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnterpriseController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\VerifyUserStatusController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\OrderControlController;
use App\Http\Controllers\PaymentControlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'admin', 'admin@admin.com', NULL, '$2y$10$nLAKNOVvyeCI0DFqqwEbZ.YHFxLbw.cUEWsg.gqXPMPe88R.m9fhi', NULL, NULL, NULL, NULL, NULL, '3', NULL, '2021-08-11 03:00:48', '2021-08-12 04:02:40')

*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/buy-system', [VerifyUserStatusController::class,'buySystem']);

    Route::get('/payment-system', [VerifyUserStatusController::class,'paymentSystem']);
    Route::post('/payment-system', [VerifyUserStatusController::class,'paymentSystemStore']);
    Route::post('/get-demo-system', [VerifyUserStatusController::class,'getDemoSystem']);

    Route::get('/new-user-enterprise', [VerifyUserStatusController::class,'enterprise']);
    Route::post('/new-user-enterprise', [VerifyUserStatusController::class,'enterpriseStore']);

    Route::get('/new-user-employee', [VerifyUserStatusController::class,'employee']);
    Route::post('/new-user-employee', [VerifyUserStatusController::class,'employeeStore']);

    Route::get('/new-user-employee-child', [VerifyUserStatusController::class,'newUserEmployeeChild']);
    Route::post('/new-user-employee-child', [EmpController::class,'store']);
    Route::post('/new-user-employee-child/next', [VerifyUserStatusController::class,'newUserEmployeeChildNext']);

    Route::get('/add-new-product-group', [VerifyUserStatusController::class,'addNewProductGroup']);
    Route::post('/add-new-product-group', [ProductGroupController::class,'store']);
    Route::post('/add-new-product-group/next', [VerifyUserStatusController::class,'addNewProductGroupNext']);
    
    Route::get('/add-new-product', [VerifyUserStatusController::class,'addNewProduct']);
    Route::post('/add-new-product', [ProductController::class,'store']);
    Route::post('/add-new-product/next', [VerifyUserStatusController::class,'addNewProductNext']);

    Route::get('/create-type-payment', [VerifyUserStatusController::class,'createTypePayment']);
    Route::post('/create-type-payment', [PaymentTypeController::class,'store']);
    Route::post('/create-type-payment/next', [VerifyUserStatusController::class,'createTypePaymentNext']);
    
});

Route::middleware(['auth','auth:sanctum', 'verifyuserstatus'])->group(function(){
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/learning-system', [LearningSystemController::class,'index']);

    Route::get('/enterprise', [EnterpriseController::class,'index'])->name('enterprise');
    Route::post('/enterprise/create', [EnterpriseController::class,'store']);
    Route::get('/enterprise/edit/{id}', [EnterpriseController::class,'edit']);
    Route::post('/enterprise/update/{id}', [EnterpriseController::class,'update']);
    Route::post('/enterprise/delete/{id}', [EnterpriseController::class,'delete']);
    
    Route::post('/payment-methods/{enterprise_id}', [PaymentMethodsController::class,'store']);
    Route::get('/payment-methods/edit/{id}', [PaymentMethodsController::class,'edit']);
    Route::post('/payment-methods/update/{id}', [PaymentMethodsController::class,'update']);
    Route::post('/payment-methods/delete/{id}', [PaymentMethodsController::class,'delete']);

    Route::get('/promotions', [PromotionsController::class,'index'])->name('promotions');
    Route::post('/promotions/create', [PromotionsController::class,'store']);
    Route::get('/promotions/edit/{id}', [PromotionsController::class,'edit']);
    Route::post('/promotions/update/{id}', [PromotionsController::class,'update']);
    Route::post('/promotions/delete/{id}', [PromotionsController::class,'delete']);

    Route::get('/emp', [EmpController::class,'index'])->name('emp');
    Route::post('/emp', [EmpController::class,'store']);
    Route::get('/emp/{id}', [EmpController::class,'view']);
    Route::post('/emp/{id}', [EmpController::class,'update']);
    Route::post('/emp/delete/{id}', [EmpController::class,'delete']);
    
    Route::get('/product-group', [ProductGroupController::class,'index'])->name('products-group');
    Route::post('/product-group', [ProductGroupController::class,'store']);
    Route::get('/product-group/{id}', [ProductGroupController::class,'view']);
    Route::post('/product-group/{id}', [ProductGroupController::class,'update']);
    Route::post('/product-group/delete/{id}', [ProductGroupController::class,'delete']);
   
    Route::get('/product', [ProductController::class,'index'])->name('products');
    Route::post('/product', [ProductController::class,'store']);
    Route::get('/product/{id}', [ProductController::class,'view']);
    Route::post('/product/{id}', [ProductController::class,'update']);
    Route::post('/product/delete/{id}', [ProductController::class,'delete']);
   
    Route::get('/payment-type', [PaymentTypeController::class,'index'])->name('payment-type');
    Route::post('/payment-type', [PaymentTypeController::class,'store']);
    Route::get('/payment-type/{id}', [PaymentTypeController::class,'view']);
    Route::post('/payment-type/{id}', [PaymentTypeController::class,'update']);
    Route::post('/payment-type/delete/{id}', [PaymentTypeController::class,'delete']);
    
    Route::get('/order-control', [OrderControlController::class,'index'])->name('order-control');
    Route::post('/order-control', [OrderControlController::class,'store']);
    Route::post('/order-control/{id}', [OrderControlController::class,'delete']);

    // Route::get('/payment', [PaymentControlController::class,'index']);
    Route::get('/invoice/{id}', [PaymentControlController::class,'invoice']);
    Route::get('/invoice-print/{id}', [PaymentControlController::class,'print']);
    Route::post('/payment', [PaymentControlController::class,'store']);
     
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller 
{   
    public function indexPay(){
        return view('sell.banhang');
    }

    // lấy dữ liệu từ form
    public function savePay(Request $request){
        // lấy dữ liệu từ form
        $name = $request->input('name-customer');
        $phone = $request->input('phonenumber-customer');
        // $id = $request->input('id-product');
        dd($name, $phone);
        if($_SERVER['REQUEST_METHOD'] == "POST"){
        }
        // return redirect()->back();
    }
}
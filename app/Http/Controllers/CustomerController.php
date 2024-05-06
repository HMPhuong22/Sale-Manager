<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // index
    public function indexCustomer(){
        return view("manage.soquy.khachhang");
    }
}

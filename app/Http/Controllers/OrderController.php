<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // index
    public function indexOrder(){
        return view('manage.baocao.thongkedondat');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    // 
    public function indexSales(){
        return view('manage.baocao.doanhthu');
    }
}

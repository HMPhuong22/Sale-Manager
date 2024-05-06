<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellMasterController extends Controller
{
    // index
    public function indexSellMaster(){
        return view('sell.header-sell');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerController extends Controller
{
    // index
    public function indexPartner(){
        return view('manage.soquy.doitac');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    
    protected $partner;
    public function __construct(){
        $this->partner = new Partner();
    }
    // index
    public function indexPartner(){
        $getDataPartner = $this->partner->getAllPartnerl();
        return view('manage.soquy.doitac', compact('getDataPartner'));
    }
}

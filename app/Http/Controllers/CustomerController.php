<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerController extends Controller
{
    protected $customer;
    public function __construct(){
        $this->customer = new Customer();
    }
    // index
    public function indexCustomer() {
        $getAllCustomer = $this->customer->getCustomerAndSumInvoice();
        return view("manage.soquy.khachhang", compact('getAllCustomer'));
    }
}

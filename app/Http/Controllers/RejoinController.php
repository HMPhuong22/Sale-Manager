<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pay;

class RejoinController extends Controller
{
    protected $invoiceDetails;
    public function __construct(){
        $this->invoiceDetails = new Pay();
    }
    //
    public function indexRejoin(){
        return view('sell.trahang');
    }

    public function RejoinHandle(Request $request){
        // lấy ID hóa đơn xuất - DONE
        $idHoadonxuat = $request->input('mahoadonxuat');
        // Dữ liệu hóa đơn
        $dataInvoice = $this->invoiceDetails->getExportInvoiceDetails($idHoadonxuat);
        $dataCustomer = $this->invoiceDetails->getDataCustomer($idHoadonxuat);
        // dd($dataCustomer);
        return view('sell.trahang', compact('dataInvoice', 'dataCustomer'));
    }
}
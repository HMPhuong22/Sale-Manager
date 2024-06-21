<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Time;

class importInvoicePDF extends Controller
{
    public function index(Request $request){
        $invoiceData = $request->all();
        dd($invoiceData);
        return view('admin.quanly.importInvoicePDF');
    }
    public function store(Request $request)
    {
        // Thu thập dữ liệu từ request
        $invoiceData = $request->all();
        // dd($invoiceData);
        // Lưu dữ liệu hóa đơn vào cơ sở dữ liệu (nếu cần)

        // Lấy thời gian hiện tại
        $time = new Time();
        $getTime = $time->getTime();

        // Tạo PDF từ dữ liệu hóa đơn
        $pdf = Pdf::loadView('manage.quanly.importInvoicePDF', ['invoice' => $invoiceData]);

        // Trả về file PDF
        return $pdf->stream('invoice.pdf');
    }
}

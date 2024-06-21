<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\InvoicePDF;
use App\Models\Pay;
use App\Models\Time;
use App\Models\ListShopping;
use Illuminate\Support\Facades\Session;

class PrintInvoiceController extends Controller
{
    protected $exportInvoice;
    protected $getIdInvoice;
    protected $getTimeHN;
    public function __construct()
    {
        $this->exportInvoice = new InvoicePDF();
        $this->getIdInvoice = new Pay();
        $this->getTimeHN = new Time();
    }
    // giao diện trang hóa đơn bán hàng
    public function indexInvoice(Request $request)
    {
        // lấy id của hóa đơn mới nhất
        $getId = $this->getIdInvoice->getIdNewest();
        $list = new ListShopping();
        // dd($list->GetListInvoiceByMonth($this->getTimeHN->GetYear(), $this->getTimeHN->GetMonth()));
        $dataExportInvoice = [
            'time' => $this->getTimeHN->getTime(),
            'invoice' => $this->exportInvoice->getDataInvoice($getId),
        ];
        // dd($test);
        $pdf = Pdf::loadView('sell.PrintInvoice', $dataExportInvoice);
        return $pdf->stream('invoicePDF.pdf');
    }
}

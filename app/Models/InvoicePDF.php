<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class InvoicePDF extends Model
{
    use HasFactory;

    protected $product = 'tbl_sanpham';
    protected $exportInvoice = 'tbl_hoadonxuat';
    protected $exportInvoiceDetails = 'tbl_chitiethdx';
    protected $customer = 'tbl_khachhang';

    public function getDataInvoice($id){
        $getDataExportInvoice = DB::table($this->exportInvoice)
        ->join($this->exportInvoiceDetails, $this->exportInvoice.'.id_hoadonxuat', '=', $this->exportInvoiceDetails.'.id_hoadonxuat')
        ->join($this->product, $this->exportInvoiceDetails.'.id_sanpham', '=', $this->product.'.id_sanpham')
        ->join($this->customer, $this->exportInvoice.'.id_khachhang', '=', $this->customer.'.id_khachhang')
        ->where($this->exportInvoice.'.id_hoadonxuat', $id)
        ->first();
        return $getDataExportInvoice;
    }
}

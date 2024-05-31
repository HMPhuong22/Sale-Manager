<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pay extends Model
{
    use HasFactory;
    protected $tableDetails = 'tbl_chitiethdx';
    protected $table = 'tbl_hoadonxuat';

    // INVOICE EXPORT

    // add export invoice - Lấy tổng giá xuất và ID khách hàng
    public function saveExportInvoice($data){
        $dataExportInvoice = DB::table($this->table)
        ->insert($data);
        return $dataExportInvoice;
    }

    // lấy id mới nhất
    public function getIdNewest(){
        $Idnewest = DB::table($this->table)->max('id_hoadonxuat');
        return $Idnewest;
    }

    // Tạo mã đơn hàng
    public function makeIdInvoice(){
        $string = 'HDB';
        $code = "";
        for ($i = 0; $i < 8; $i++) {
            $code .= random_int(0, 9);
        }
        return $string.$code;
    }

    // INVOICE EXPORT DETAILS

    // add export invoice details
    public function saveDetailExportInvoice($data){
        $dataDetails = DB::table($this->tableDetails)
        ->insert($data);
        return $dataDetails;
    }

    // update lại tổng số lượng sản phẩm 
    public function updateNewQuantity($idProduct, $newQuantity){
        $update = DB::table('tbl_sanpham')
        ->where('id_sanpham', $idProduct)
        ->update(['soluong' => $newQuantity]);
        return $update;
    }

    // -------------- XỬ LÝ THÔNG TIN TRẢ HÀNG --------------
    // lấy thông tin hóa đơn bán theo ID hóa đơn bán hàng
    public function getExportInvoice($idInvoice){
        $dataExportInvoice = DB::table($this->table)
        ->where('id_hoadonxuat', $idInvoice)
        ->first();
        return ($dataExportInvoice);
    }

    // lấy thông tin chi tiết hóa đơn xuất 
    public function getExportInvoiceDetails($idExportInvoice){
        $data = [
            $this->tableDetails.'.giaxuat', 
            $this->tableDetails.'.soluong', 
            'tbl_sanpham.ten_sanpham',
            $this->table.'.tonggiaxuat',
            $this->table.'.tongsoluong',
        ];  
        $dataExportInvoiceDetails = DB::table($this->tableDetails)
        ->select($data)
        ->join($this->table, $this->tableDetails.'.id_hoadonxuat', '=', $this->table.'.id_hoadonxuat')
        ->join('tbl_sanpham', $this->tableDetails.'.id_sanpham', '=', 'tbl_sanpham.id_sanpham')
        ->join('tbl_dactrungsanpham', 'tbl_sanpham.id_sanpham', '=', 'tbl_dactrungsanpham.id_sanpham')
        ->join('tbl_kichthuoc', 'tbl_dactrungsanpham.id_kichthuoc', '=', 'tbl_kichthuoc.id_kichthuoc')
        ->where($this->table.'.id_hoadonxuat', $idExportInvoice)
        ->get();
       
        return $dataExportInvoiceDetails;
    }

    // thông tin khách hàng theo id hóa đơn xuất
    public function getDataCustomer($idExportInvoice){
        $dataCustomer = DB::table($this->table . ' AS hd') // Gán biệt danh 'hd' cho lần xuất hiện đầu tiên
        ->select('kh.*')
        ->join('tbl_khachhang AS kh', 'hd.id_khachhang', '=', 'kh.id_khachhang')
        ->where('hd.id_hoadonxuat', $idExportInvoice)
        ->get();
    return $dataCustomer;
    }
}
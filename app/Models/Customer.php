<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class Customer extends Model
{
  use HasFactory;

  protected $table = 'tbl_khachhang'; // Tên của bảng trong database

  protected $primaryKey = 'id_khachhang'; // Khóa chính của bảng

  protected $fillable = ['ten_khachhang', 'sodienthoai', 'ma_khachhang']; // Các cột có thể gán dữ liệu vào

  // Nếu bạn không sử dụng timestamps (created_at, updated_at), bạn có thể set bằng false
  public $timestamps = false;

  public function getAllCustomer()
  {
    $getAllData = DB::table($this->table)
      ->get();
    return $getAllData;
  }

  public function getIdCustomer($numberPhone)
  {
    $get = DB::table($this->table)
      ->select('id_khachhang')
      ->where('sodienthoai', $numberPhone)
      ->first();
    return $get;
  }

  // thêm khách hàng
  public function addCustomer($data)
  {
    $add = DB::table($this->table)->insert($data);
    return $add;
  }

  // update thông tin khách hàng
  public function updateCustomer($name, $numberPhone)
  {
    $update = DB::table($this->table)
      ->where('sodienthoai', $numberPhone)
      ->update($name);
    return $update;
  }

  public function generateCustomerCode()
  {
    $code = "";
    for ($i = 0; $i < 8; $i++) {
      $code .= random_int(0, 9);
    }
    return $code;
  }

  // lấy danh sách khách hàng và tổng đơn hàng khách đặt
  public function getCustomerAndSumInvoice(){
    $get = DB::table($this->table)
    ->join('tbl_hoadonxuat', $this->table.'.id_khachhang', '=', 'tbl_hoadonxuat.id_khachhang')
    ->join('tbl_chitiethdx', 'tbl_hoadonxuat.id_hoadonxuat', '=', 'tbl_chitiethdx.id_hoadonxuat')
    ->select($this->table.'.*', 
              DB::raw('count('.'tbl_hoadonxuat.id_khachhang'.') as countExportInvoice'), 
              DB::raw('sum('.'tbl_chitiethdx.soluong*tbl_chitiethdx.giaxuat'.') as sumExportInvoice'))
    ->groupBy($this->table.'.id_khachhang', $this->table.'.ten_khachhang',$this->table.'.sodienthoai', $this->table.'.ma_khachhang')
    ->get();
    return $get;
  }
}

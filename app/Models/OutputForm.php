<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OutputForm extends Model
{
    use HasFactory;

    protected $table = 'tbl_hoadonxuat'; // Tên của bảng trong database

    protected $primaryKey = 'id_hoadonxuat'; // Khóa chính của bảng

    protected $fillable = ['tonggiaxuat', 'tonggiagiam', 'tongsoluong' , 'thoigian', 'id_khachhang', 'ma_hoadonxuat']; // Các cột có thể gán dữ liệu vào

    // Nếu bạn không sử dụng timestamps (created_at, updated_at), bạn có thể set bằng false
    public $timestamps = false;

    public function getInfInvoice($phoneNumber){
        $get = DB::table($this->table)
        ->select($this->table.'.thoigian', $this->table.'.ma_hoadonxuat', 'kh.sodienthoai')
        ->join('tbl_khachhang as kh', $this->table.'.id_khachhang', '=', 'kh.id_khachhang')
        ->where('kh.sodienthoai', 'LIKE', '%' . $phoneNumber . '%')
        ->get();
        return $get;
    }

    // lấy dữ liệu bán hàng theo ngày
    public function getDataOrderByDay($day){
        $sql = $sql = "SELECT count(id_hoadonxuat) as total_orders, sum(tonggiaxuat) as total_revenue
        FROM " . $this->table . "
        WHERE thoigian BETWEEN ? AND ?";

        $bindings = [$day . ' 00:00:00', $day . ' 23:59:59'];
        $results = DB::select($sql, $bindings);
        return $results;
    }

    // tính tiền bán hàng theo thời gian
    public function totalSellByMonth($year, $month){
        $sql = $sql = "SELECT sum(tonggiaxuat) as total_money
        FROM " . $this->table . "
        WHERE thoigian BETWEEN ? AND ?";

        $bindings = [$year.'-'.$month.'-1'.' 00:00:00', $year.'-'.$month.'-31'.' 23:59:59'];
        $results = DB::select($sql, $bindings);
        return $results; 
    }

    // tính tổng lượng hàng đã bán
    public function getTotalProduct($year, $month){
        $sql = $sql = "SELECT sum(tongsoluong) as total_product
        FROM " . $this->table . "
        WHERE thoigian BETWEEN ? AND ?";

        $bindings = [$year.'-'.$month.'-1'.' 00:00:00', $year.'-'.$month.'-31'.' 23:59:59'];
        $results = DB::select($sql, $bindings);
        return $results;
    }

    // Mối quan hệ với bảng tbl_khachhang
    public function Customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_khachhang', 'id_khachhang');
    }

    // Mối quan hệ với bảng tbl_chitiethdx
    public function OutputformDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OutputFormDetail::class, 'id_hoadonxuat', 'id_hoadonxuat');
    }
}

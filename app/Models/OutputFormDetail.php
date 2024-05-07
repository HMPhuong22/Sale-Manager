<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputFormDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_chitiethdx'; // Tên của bảng trong database

    protected $primaryKey = 'id_chitiethdx'; // Khóa chính của bảng

    protected $fillable = ['ma_chitiethdx', 'soluong', 'giaxuat', 'id_sanpham', 'id_hoadonxuat']; // Các cột có thể gán dữ liệu vào

    // Nếu bạn không sử dụng timestamps (created_at, updated_at), bạn có thể set bằng false
    public $timestamps = false;

    // Mối quan hệ với bảng tbl_sanpham
    public function Product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_sanpham', 'id_sanpham');
    }

    // Mối quan hệ với bảng tbl_hoadonxuat
    public function OutputForm(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OutputForm::class, 'id_hoadonxuat', 'id_hoadonxuat');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputForm extends Model
{
    use HasFactory;

    protected $table = 'tbl_hoadonxuat'; // Tên của bảng trong database

    protected $primaryKey = 'id_hoadonxuat'; // Khóa chính của bảng

    protected $fillable = ['thoigian', 'id_khachhang']; // Các cột có thể gán dữ liệu vào

    // Nếu bạn không sử dụng timestamps (created_at, updated_at), bạn có thể set bằng false
    public $timestamps = false;

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

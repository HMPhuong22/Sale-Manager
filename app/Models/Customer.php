<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tbl_khachhang'; // Tên của bảng trong database

    protected $primaryKey = 'id_khachhang'; // Khóa chính của bảng

    protected $fillable = ['ten_khachhang', 'sodienthoai', 'ma_khachhang']; // Các cột có thể gán dữ liệu vào

    // Nếu bạn không sử dụng timestamps (created_at, updated_at), bạn có thể set bằng false
    public $timestamps = false;
}

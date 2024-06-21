<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AddListProduct;
use App\Models\Product;

class ImportInvoiceDetail extends Model
{
    use HasFactory;
    protected $table = 'tbl_chitiethdn';
    protected $primaryKey = 'id_chitiethdn';
    public $timestamps = false;
    protected $fillable = [
        'id_chitiethdn',
        'soluong',
        'gianhap',
        'id_sanpham',
        'id_hoadonnhap'
    ];

    // Một chi tiết hóa đơn nhập thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Một chi tiết hóa đơn nhập thuộc về một hóa đơn nhập
    public function importInvoice()
    {
        return $this->belongsTo(AddListProduct::class);
    }
}

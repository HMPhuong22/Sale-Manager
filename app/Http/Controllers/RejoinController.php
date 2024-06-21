<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ReturnForm;
use App\Models\ReturnFormDetail;
use Illuminate\Http\Request;

use App\Models\Pay;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class RejoinController extends Controller
{
    protected $invoiceDetails;
    public function __construct(){
        $this->invoiceDetails = new Pay();
    }
    //
    public function indexRejoin(Request $request, $maHoaDonXuat){
        // Dữ liệu hóa đơn
        $dataInvoice = $this->invoiceDetails->getExportInvoiceDetails($maHoaDonXuat);
        $dataCustomer = $this->invoiceDetails->getDataCustomer($maHoaDonXuat);
        // dd($dataCustomer);
        return view('sell.trahang', compact('dataInvoice', 'dataCustomer', 'maHoaDonXuat'));
    }

    public function rejoinHandle(Request $request){
        DB::beginTransaction();
        
            $tongGiaTra = $request->get('tongGiaTra');
            $tongSoLuong = $request->get('tongSoLuong');
            $idHoadonXuat = $request->get('idHoadonXuat');
            $idKhachHang = $request->get('idKhachHang');
            $sanphamsStr = $request->get('sanphams');

            $returnForm = ReturnForm::query()->create([
                "tonggiatra"=> $tongGiaTra,
                "tongsoluong" => $tongSoLuong,
                "id_hoadonxuat"=>$idHoadonXuat,
                "id_khachhang" =>$idKhachHang,
            ]);

            $sanphams = json_decode($sanphamsStr, true);

            $returnFormDetailData = [];
            foreach ($sanphams as $sanpham) {
                $returnFormDetailData[] = [
                    "id_trahang"=> $returnForm->id_trahang,
                    "id_sanpham" => $sanpham["id"],
                    "soluong" => $sanpham["soluong"]
                ];
                $sanphamGet = Product::query()->find($sanpham["id"]);
                
                // cập nhật lại số lượng sản phẩm trong kho hàng
                $sanphamGet->update([
                    "soluong" => $sanphamGet->soluong + $sanpham["soluong"]
                ]);
            }

            ReturnFormDetail::query()->insert($returnFormDetailData);

            DB::commit();
            return response()->json("success");
        
    }
}

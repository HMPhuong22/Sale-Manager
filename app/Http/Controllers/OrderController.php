<?php

namespace App\Http\Controllers;

use App\Models\OutputForm;
use App\Models\OutputFormDetail;
use App\Models\Product;
use App\Models\ListShopping;
use App\Models\Time;

use Illuminate\Http\Request;
use Faker\Factory as Faker;

class OrderController extends Controller
{
    // index
    public function indexOrder()
    {
        // return view('manage.baocao.thongkedondat');
    }

    public function addDonXuat()
    {
        $faker = Faker::create();

        // Tạo 1000 dữ liệu giả cho bảng OutputForm
        for ($i = 0; $i < 1000; $i++) {
            // Tạo mã hóa đơn duy nhất
            $maHoaDon = 'HDB' . $faker->unique()->regexify('[0-9]{8}');
            // Biến để tính tổng giá xuất
            $tgx = 0;
            $tgg = 0;
            $tsl = 0;

            $outputForm = OutputForm::create([
                'tonggiaxuat' => $tgx,
                'tonggiagiam' => $tgg,
                'tongsoluong' => $tsl,
                'thoigian' => $faker->dateTimeBetween('-3 years', 'now'),
                'id_khachhang' => $faker->numberBetween(1, 100),
                'ma_hoadonxuat' => $maHoaDon,
            ]);

            // Tạo từ 1 đến 3 dữ liệu giả cho bảng OutputFormDetail cho mỗi OutputForm
            $numDetails = $faker->numberBetween(1, 3);
            for ($j = 0; $j < $numDetails; $j++) {
                $productId = $faker->randomElement([76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97]);
                $product = Product::find($productId);

                // Giá sản phẩm và số lượng ngẫu nhiên
                $soLuong = $faker->numberBetween(1, 4);
                $giaXuat = $product->gia * $soLuong;

                // Tính tổng giá xuất
                $tgx += $giaXuat;

                $outputFormDetail = OutputFormDetail::create([
                    'ma_chitiethdx' => $faker->unique()->uuid, // Tạo mã chitietdx unique
                    'soluong' => $soLuong,
                    'giaxuat' => $giaXuat,
                    'id_sanpham' => $productId,
                    'id_hoadonxuat' => $outputForm->id_hoadonxuat,
                ]);
            }

            // Tạo tổng giá giảm, không vượt quá 30% tổng giá xuất
            $tgg = $faker->numberBetween(0, (int)($tgx * 0.3));

            // Tổng số lượng cho hóa đơn bán hàng
            $tsl += $soLuong;

            // Cập nhật lại OutputForm với tổng giá xuất và tổng giá giảm
            $outputForm->update([
                'tonggiaxuat' => $tgx,
                'tonggiagiam' => $tgg,
                'tongsoluong' => $tsl
            ]);
        }
        return response()->json(['message' => 'Fake data generated successfully'], 200);
    }

    public function SelectOptionHandle(Request $request)
    {
        // lấy dữ liệu về thời gian
        $time = new Time();
        $day = $time->GetDay();
        $month = $time->GetMonth();
        $year = $time->GetYear();
        // lấy dữ liệu về hóa dơn theo thời gian
        $listData = new ListShopping();
        $thisDay = $listData->GetListInvoiceByDate($day);
        $thisMonth = $listData->GetListInvoiceByMonth($year, $month);
        $thisYear = $listData->GetListInvoiceByYear($year);
        return view('manage.baocao.thongkedondat', compact('thisDay', 'thisMonth', 'thisYear'));
    }

    // tìm kiếm sản phẩm theo số điện thoại
    public function searchInvoice(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $searchTerm = $request->input('phone');

        // tìm kiếm hóa đơn bán hàng theo số điện thoại
        $getInf = new OutputForm();
        $invoices = $getInf->getInfInvoice($searchTerm);

        // Trả về view với kết quả tìm kiếm
        return response()->json($invoices);
    }
}

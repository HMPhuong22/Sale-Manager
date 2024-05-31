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
            $outputForm = OutputForm::create([
                'thoigian' => $faker->dateTimeBetween('-3 years', 'now'),
                'id_khachhang' => $faker->numberBetween(1, 100),
            ]);

            // Tạo từ 1 đến 3 dữ liệu giả cho bảng OutputFormDetail cho mỗi OutputForm
            $numDetails = $faker->numberBetween(1, 3);
            for ($j = 0; $j < $numDetails; $j++) {
                $productId = $faker->randomElement([23, 24, 25, 26, 27, 28, 29, 30, 31, 33, 34, 36, 37, 38, 39, 40, 41]);
                $product = Product::find($productId);

                $outputFormDetail = OutputFormDetail::create([
                    'ma_chitiethdx' => $faker->unique()->uuid, // Tạo mã chitietdx unique
                    'soluong' => $faker->numberBetween(1, 4),
                    'giaxuat' => $product->gia, // Lấy giá xuất từ sản phẩm
                    'id_sanpham' => $productId,
                    'id_hoadonxuat' => $outputForm->id_hoadonxuat,
                ]);
            }
        }
        return response()->json(['message' => 'Fake data generated successfully'], 200);
    }

    public function SelectOptionHandle(Request $request){
        // lấy dữ liệu về thời gian
        $time = new Time();
        $day = $time->GetDay();
        $month = $time->GetMonth();
        $year = $time->GetYear();
        // lấy dữ liệu về hóa dơn theo thời gian
        $listData = new ListShopping();
        $thisDay = $listData->GetListInvoiceByDate($day);
        $thisMonth = $listData->GetListInvoiceByMonth($year, $month );
        $thisYear = $listData->GetListInvoiceByYear($year);
        return view('manage.baocao.thongkedondat', compact('thisDay', 'thisMonth', 'thisYear'));
    }   
}

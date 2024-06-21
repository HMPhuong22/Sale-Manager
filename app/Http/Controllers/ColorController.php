<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\CovertString;

class ColorController extends Controller
{
    protected $color;
    public function __construct()
    {
        $this->color = new Color();
    }

    // index
    public function indexColor()
    {
        $listColor = $this->color->all();
        return view('manage.hanghoa.themmausac', compact('listColor'));
    }

    // thêm màu sắc
    public function AddColor(Request $request)
    {
        // validate data
        $rules = [
            'nameColor' => 'unique:tbl_mausac,ma_mausac|regex:/^[a-zA-Z\s]+$/',
        ];
        $messages = [
            'unique' => 'Màu đã tồn tại',
            'regex' => 'Chỉ được chứa chữ cái và khoảng trắng',
        ];
        $request->validate($rules, $messages);

        $this->color->ten_mausac = $request->input('nameColor');
        $cvs = new CovertString();
        $ma = $request->input('nameColor');
        $this->color->ma_mausac = $cvs->generateCodeColor($ma); 
        $this->color->save();
        return redirect()->back()->with('msgColor', 'Thêm mới thành công');
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\UserSignin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    private $user;
    public  function __construct() {
        $this->user = new UserSignin();
    }
    // *-----------------------ĐĂNG KÝ 
    public function index(){}
    public function Signup(){
        // hiển thị giao diện trang đăng ký
        return view('auth.dangky');
    }
    public function SignupHandle(Request $request){

        // validate form
        $rules = [
            'name-signin' => 'required|string|min:8|unique:users,name',
            'sdt-signin' => 'required|unique:users,sodienthoai',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ];

        $message = [
            'required'=> 'Vui lòng nhập đầy đủ thông tin',
            'name-signin.min'=> 'Tên đăng nhập phải ít nhất :min ký tự',
            'name-signin.unique'=> 'Tên đăng nhập đã tồn tại',
            'sdt-signin.unique'=> 'Số điện thoại đã được đăng ký',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp'
        ];

        $request->validate($rules, $message);

        // Lấy dữ liệu người dùng vào từ form
        $dataSignin = [
            'name' => $request->input('name-signin'),
            'sodienthoai' => $request->input('sdt-signin'),
            'password' => bcrypt($request->input('password'))
        ];

        $this->user->addUser($dataSignin);
        return redirect()->route('dangnhap')->with('msg', "Đăng ký thành công");
    }

    //*-----------------------ĐĂNG NHẬP
    public function Login(){
        return view('auth.dangnhap');
    }

    public function LoginHandle(Request $request){
        $checkLogin = [
            'sodienthoai' => $request->input('login-name'),
            'password' => $request->input('pass')
        ];
        if(Auth::attempt($checkLogin)){   
            $action = $request->input('manage');
            if($action){
                return redirect()->route('admin.quanly.manage-index');
            }elseif (!$action) {
                return redirect()->route('admin.banhang.banhang-index');
            }
        }else{
            return redirect()->back()->with('msg', 'Thông tin đăng nhập không hợp lệ');
        }
    }
}
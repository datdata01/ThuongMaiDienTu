<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $req)
    {
        $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
        ]);

        if (Auth::attempt([
            'email' => $req->email,
            'password' => $req->password,
        ])) {
            if (Auth::user()->role == '1') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('users.home');
            }
        } else {
            return redirect()->back()->with([
                'messageError' => 'Email hoặc mật khẩu không đúng'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with([
            'messageError' => 'Đăng xuất thành công'
        ]);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Thêm phương thức đăng ký
    public function register()
    {
        return view('register');
    }

    public function postRegister(Request $req)
    {
        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        ]);

        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'role' => '0', // Hoặc giá trị phù hợp với vai trò mặc định
        ]);

        return redirect()->route('login')->with([
            'message' => 'Đăng ký thành công! Vui lòng đăng nhập.'
        ]);
    }
}

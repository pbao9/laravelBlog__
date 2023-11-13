<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Validator;

class AuthorLoginForm extends Component
{
    public $login_id, $password;

    public function LoginHandler()
    {

        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email') {
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5',
            ], [
                'login_id' => 'Email và tên đăng nhập không được trống!',
                'login_id.email' => 'Email không đúng!',
                'loign_id.exists' => 'Email không tồn tại!',
                'password.required' => 'Mật khẩu không được trống!',
            ]);
        } else {
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5',
            ], [
                'login_id.required' => 'Email hoặc tên đăng nhập không được trống!',
                'login_id.exists' => 'Tên đăng nhập chưa được đăng ký!',
                'password.required' => 'Mật khẩu không được để trống'
            ]);
        }

        $creds = array($fieldType => $this->login_id, 'password' => $this->password);
        $checkUser = User::where($fieldType, $this->login_id)->first();
        if (Auth::guard('web')->attempt($creds)) {
            if ($checkUser->blocked == 1) {
                return redirect()->route('author.login')->with('fail', 'Tài khoản của bạn đã bị khoá!');
            } else {
                return redirect()->route('author.home');
            }
        } else {
            session()->flash('fail', 'Sai email/ tên đăng nhập hoặc mật khẩu!');
        }




        // Đăng nhập bằng mỗi email
        // $this->validate([
        //     'email' => 'required|email|exists:users,email',
        //     'password' => 'required|min:5'
        // ], [
        //     'email.required' => 'Nhập địa chỉ email của bạn!',
        //     'email.email' => 'Email không tồn tại',
        //     'email.exists' => 'Email chưa được đăng ký trong database!',
        //     'password.required' => 'Vui lòng nhập mật khẩu'
        // ]);

        // $creds = array('email' => $this->email, 'password' => $this->password);
        // if (Auth::guard('web')->attempt($creds)) {
        //     $checkUser = User::where('email', $this->email)->first();

        //     if ($checkUser->blocked == 1) {
        //         Auth::guard('web')->logout();
        //         return redirect()->route('author.login')->with('fail', 'Acc của bạn đã bị khoá!');
        //     } else {
        //         return redirect()->route('author.home');
        //     }
        // } else {
        //     session()->flash('fail', 'Sai email hoặc mật khẩu, vui lòng nhập lại!');
        // }
    }


    public function render()
    {
        return view('livewire.author-login-form');
    }
}

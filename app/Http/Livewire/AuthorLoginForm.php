<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Validator;

class AuthorLoginForm extends Component
{
    public $email, $password;

    public function LoginHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:user,mail',
            'password' => 'required|min:5'
        ], [
            'email.required' => 'Nhập địa chỉ email của bạn!',
            'email.email' => 'Email không tồn tại',
            'email.exists' => 'Email chưa được đăng ký trong database!',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);

        $creds = array('email' => $this->email, 'password' => $this->password);
        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where('email', $this->email)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.home')->with('fail', 'Acc của bnạ đã bị khoá!');
            } else {
                return redirect()->route('author.home');
            }
        } else {
            session()->flash('fail', 'Sai email hoặc mật khẩu, vui lòng nhập lại!');
        }
    }


    public function render()
    {
        return view('livewire.author-login-form');
    }
}

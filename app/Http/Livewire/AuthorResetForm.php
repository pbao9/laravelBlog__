<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthorResetForm extends Component
{
    public $email, $token, $new_password, $config_new_password;
    public function mount() {
        $this->email = request() -> email;
        $this->token = request() -> token;
    }
    public function ResetHandler(){
        $this->validate(
            [
                'email' => 'required|email|exists:user,email',
                'new_password' => 'required|min:5',
                'confirm_new_password' => 'same:new_password',
            ], [
                'email.required' => 'Chưa nhập email',
                'email.email' => 'Email không hợp lệ',
                'email.exists' => 'Email chưa đăng ký',
                'new_password.required' => 'Chưa nhập mật khẩu mới',
                'new_password.min' => 'Mật khẩu tối thiểu 5 ký tự',
                'confirm_new_password' => 'Mật khẩu không trùng khớp'
            ]
            );
    }
    public function render()
    {
        return view('livewire.author-reset-form');
    }
}

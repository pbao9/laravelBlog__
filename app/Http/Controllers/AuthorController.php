<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthorController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('back.pages.home');
    }
}

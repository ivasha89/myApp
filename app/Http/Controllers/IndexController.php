<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        session()->forget('token');
        $this->sessionData();
        return view('index');
    }

    public static function sessionData()
    {
        if (auth()->user() && !session('name')) {
            session()->put('name', auth()->user()->name);
            session()->put('id', auth()->user()->id);
            session()->put('right', auth()->user()->right);
        }
    }
}

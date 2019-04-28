<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public static function sessionData()
    {
        if (Auth::viaRemember() && !session('name')) {
            session()->put('name', auth()->user()->name);
            session()->put('id', auth()->user()->id);
            session()->put('right', auth()->user()->right);
        }
    }
    public function index(Request $request)
    {
        $request->session()->forget('token');
        $this->sessionData();
        return view('index');
    }
}

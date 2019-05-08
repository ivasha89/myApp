<?php

namespace App\Http\Controllers;

use App\User;

class IndexController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        session()->forget('token');
        $this->sessionData();
        return view('index', compact('user'));
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

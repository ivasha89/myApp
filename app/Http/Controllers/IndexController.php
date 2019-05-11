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
}

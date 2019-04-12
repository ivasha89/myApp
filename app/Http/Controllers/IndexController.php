<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget('token');

        $appname = VariablesController::$appname;

        $test = new VariablesController();
        $usrstr = $test::init()['frst'];
        $loggedin = $test::init()['scnd'];

        return view('index', compact('appname', 'usrstr', 'loggedin'));
    }
}

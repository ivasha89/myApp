<?php

namespace App\Http\Controllers;


class IndexController extends Controller
{
    public static function index()
    {
        $appname = VariablesController::$appname;

        $test = new VariablesController();
        $usrstr = $test::init()['frst'];
        $loggedin = $test::init()['scnd'];

        return view('index', compact('appname', 'usrstr', 'loggedin'));
    }
}

<?php

namespace БСШСА\Http\Controllers;


class IndexController extends Controller
{
    public static function index()
    {

        $user = '';
        $appname = 'БСШСА';
        session_start();
        if(isset($_SESSION['name'])) {
            $loggedin = TRUE;
            $user = $_SESSION['name'];
            $usrstr = "($user)";
        }
        else {
            $usrstr = '(Гость)';
            $loggedin = FALSE;
        }
        return view('index', compact('appname', 'loggedin', 'user', 'usrstr'));
    }
}

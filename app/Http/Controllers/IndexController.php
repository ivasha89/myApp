<?php

namespace БСШСА\Http\Controllers;


class IndexController extends Controller
{
    public function index()
    {

        $user = '';
        $appname = env('APP_NAME');
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

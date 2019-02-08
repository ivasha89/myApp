<?php

namespace БСШСА\Http\Controllers;

use Illuminate\Http\Request;
use БСШСА\User;
use БСШСА\Brah;

class InterController extends Controller
{
    public function signup()
    {
        $brah = new Brah;
        $brah->name = request('name');
        $brah->sname = request('sname');
        $brah->ids = request('ids');
        $brah->save();

        $user = new User();
        $user->ids = request('ids');
        $user->pssw = request('pssw');
        $user->rights = request('rights');
        $user->save();

        return view('signup');
    }

    public function login()
    {

    }
}

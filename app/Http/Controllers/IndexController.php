<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function user(User $user)
    {
        $id = str_split($user->id, 2);
        $idYear = '20'.$id[0].'-08-25';
        $daysInAshram = (integer)((new \DateTime("$idYear"))->diff(new \DateTime('now'))->days);

        return view('user.page', compact('user', 'daysInAshram'));
    }

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

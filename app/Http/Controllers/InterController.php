<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class InterController extends Controller
{

    public static function store(Request $request)
    {
        if ($request->has('psrd')) {

            $secretWord = User::where('id', 'B17004')->first();
            $tkn = Hash::check(request()->psrd, $secretWord->pssw);
            $request->session()->put('tkn', $tkn);
            if ($tkn)
            {
                return redirect('/signup');
            }
            else
            {
                $request->validate ([
                    'psrd' => ['custom' => ['reg' => ['fault']]]
                ]);
                return redirect('/check');
            }
        }
    }

    protected function registration(Request $request)
    {
        if (isset($_SESSION['user'])) MyFunctions::destroySession();

        $request->validate ([
            'id' => ['required', 'string', 'min:6', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'spiritualName' => [],
            'rt' => []
        ]);

        User::create([
            'name' => $request->name,
            'pssw' => Hash::make($request->password),
            'right' => $request->rt,
            'id' => $request->id
        ]);

        if($request->has('spiritualName')) {
            Brah::create([
            'name' => $request->name,
            'sname' => $request->spiritualName,
            'tel' => '',
            'city' => '',
            'user_id' => $request->id
        ]);}
        else {
            Brah::create([
                'name' => $request->name,
                'sname' => '',
                'tel' => '',
                'city' => '',
                'user_id' => $request->id
            ]);
        }

        $request->session()->put('name', $request->name);
        $request->session()->put('rt', $request->rt);
        $request->session()->put('id', $request->id);

        return redirect('/index');
    }

    public function signup()
    {
        $tkn = session('tkn');

        return view('signup')->with('tkn',$tkn);
    }
}
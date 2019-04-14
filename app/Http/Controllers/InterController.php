<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class InterController extends Controller
{
    public function check(Request $request)
    {
        if ($request->has('psrd')) {
            $secretWord = User::where('id', '1704')->first();
            $token = Hash::check(request()->psrd, $secretWord->pssw);
            $request->session()->put('token', $token);
            if ($token)
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
        else
            return back();
    }

    protected function registration(Request $request)
    {
        if (session('name') !== null) MyFunctions::destroySession();

        $request->validate ([
            'id' => 'required|string|min:4|max:255',
            'password' => 'required|string|min:6|max:255',
            'name' => 'required|string|min:6|max:255|unique:users',
        ]);

        if($request->has('spiritualName')) {
            Brah::create([
            'sname' => $request->spiritualName,
            'tel' => '',
            'city' => '',
            'user_id' => $request->id
        ]);}
        else {
            Brah::create([
                'sname' => '',
                'tel' => '',
                'city' => '',
                'user_id' => $request->id
            ]);
        }

        User::create([
            'name' => $request->name,
            'pssw' => Hash::make($request->password),
            'right' => $request->rt,
            'id' => $request->id
        ]);
        return redirect('/');
    }

    public function signup()
    {
        return view('guest.signup');
    }
    
    public function login()
    {
    	return view('guest.login');
    }
    
    public function enter(Request $request)
    {
    	$request->validate ([
            'password' => 'required|string|min:6|max:255',
            'name' => 'required|string|min:6|max:255',
        ]);

    	$user = User::where('name', $request->name)->first();
        $interToken = Hash::check($request->password, $user->pssw);

        if ($interToken) {
            $request->session()->put('interToken', $interToken);
            $request->session()->put('name', $user->name);
            $request->session()->put('right', $user->right);
            $request->session()->put('id', $user->id);
            $request->session()->regenerate();
            return redirect('/slbs');
        }
        else
            redirect('/login');
    }

    public function logout(Request $request)
    {
        $name = $request->session()->pull('name');
        $request->session()->flush();
        return view('guest.logout', compact('name'));
    }
}
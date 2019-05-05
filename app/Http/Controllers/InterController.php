<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class InterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function name()
    {
        return 'name';
    }
    public function check(Request $request)
    {
        if ($request->has('psrd')) {
            $password = $request->psrd;
            $secretWord = 'jointohil';
            if($password == $secretWord)
                $token = TRUE;
            else
                $token = FALSE;
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
        if (Auth::viaRemember()) {
            MyFunctions::destroySession();
            Auth::logout();
        }

        $request->validate ([
            'password' => 'required|string|min:6|max:255',
            'name' => 'required|string|min:6|max:255|unique:users',
        ]);

        $thisYear = (new \DateTime())->format('y');
        $lastUser = User::select('id')->get()->last()->id;
        $lastUserId = str_split($lastUser, 2);
        if ($lastUserId[0] == $thisYear)
            $id = $lastUserId + 1;
        else
            $id = (int)($thisYear . "01");

        if($request->has('spiritualName')) {
            Brah::create([
            'sname' => $request->spiritualName,
            'tel' => '',
            'city' => '',
            'user_id' => $id
        ]);}
        else {
            Brah::create([
                'sname' => '',
                'tel' => '',
                'city' => '',
                'user_id' => $id
            ]);
        }

        User::create([
            'name' => $request->name,
            'pssw' => Hash::make($request->password),
            'right' => $request->rt,
            'id' => $id
        ]);
        return redirect('/');
    }

    public function signup()
    {
        return view('guest.signup');
    }
    
    protected function login()
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
        $password = $request->password;
        if($request->remember == 'on')
            $remember = TRUE;
        else
            $remember = FALSE;

        if (Auth::attempt(['name' => $user, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect("/$user->id");
        }
        else
            return redirect('/login');
    }

    public function logout()
    {
        if (isset($name))
            $name = null;
        else
            $name = session()->pull('name');

        Auth::logout();
        return view('guest.logout', compact('name'));
    }
}
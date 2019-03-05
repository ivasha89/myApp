<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class InterController extends Controller
{
    static $hj, $error;

    public static function store()
    {
        $hj = self::$hj;
        if (request()->has('psrd')) {

            $rslt = User::where('id', 'B17004')->first();
            $tkn = Hash::check(request()->psrd, $rslt->pssw);
            //dd($tkn);
            if (!$tkn)
            {
                request()->validate ([
                    'psrd' => ['custom' => ['reg' => ['fault']]]
                    ]);
                return redirect('/check')->with('hj',$hj);
            }
            else
            {
                $hj = TRUE;
                return redirect('/signup')->with('hj',$hj);
            }
        }
    }

    protected function reg(Request $request)
    {
        if (isset($_SESSION['user'])) MyFunctions::destroySession();

        $data = $request->input();

        $request->validate ([
            'id' => ['required', 'string', 'min:6', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'spiritualName' => ['string', 'min:6', 'max:255'],
            'rt' => []
        ]);

        User::create([
            'name' => $request->name,
            'pssw' => Hash::make($request->password),
            'right' => $request->rt,
            'id' => $request->id
        ]);

        Brah::create([
            'name' => $request->name,
            'sname' => $request->spiritualName,
            'tel' => '',
            'city' => '',
            'user_id' => $request->id
        ]);

        $request->flashOnly('id','name', 'rt');

        return redirect('/index');
    }

    public function signup()
    {
        if(!$this->store()['hj']) {

            $attributes = [
                'hj' => self::$hj,
                'error' => self::$error
            ];
        }

        else {
            $attributes = $this->store();
        }

        return view('signup')->with('attributes',$attributes);
    }
}
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
        $attributes = [
            'hj' => self::$hj,
            'error' => self::$error
        ];
        if (request()->has('psrd')) {

            $rslt = User::where('id', 'B17004')->first();
            $tkn = Hash::check(request()->psrd, $rslt->pssw);
            $rw = $rslt->count();
            if ($rw == 0)
            {
                $a = ["Неверно ввели", "Ошибка ввода", "Снова мимо", "Беда какая-то", "Неповезло. День Сатурна", "Узнать у астролога пароль", "Может вы на сайте другого ашрама?", "Переключить раскладку на английский"];
                $attributes['error'] = VariablesController::$asa . 'href="' . url('signup') . '">' . $a[array_rand($a, 1)] . VariablesController::$bsa;
                return redirect('/signup')->with('attributes',$attributes);
            }
            elseif ($rw !== 0)
            {
                $row = $rslt;
                if ($tkn == $row)
                    $attributes['hj'] = TRUE;
                return redirect('/signup')->with('attributes',$attributes);
            }
        }
    }

    protected function reg(Request $request)
    {
        if (isset($_SESSION['user'])) MyFunctions::destroySession();

        $data = $request->input();

        $request->validate ([
            'id' => ['required', 'string', 'min:6', 'max:255'],
            'ps' => ['required', 'string', 'min:6', 'max:255'],
            'nm' => ['required', 'string', 'min:6', 'max:255'],
            'sn' => ['string', 'min:6', 'max:255'],
            'rt' => []
        ]);

        User::create([
            'name' => $request->nm,
            'pssw' => Hash::make($request->ps),
            'right' => $request->rt,
            'id' => $request->id
        ]);

        Brah::create([
            'name' => $request->nm,
            'sname' => $request->sn,
            'tel' => '',
            'city' => '',
            'user_id' => $request->id
        ]);

        $request->flashOnly('id','nm', 'rt');
        $error =  VariablesController::$asa.'href="'. url('login') .'"><h4>Дорогой бхакта, "'.$data('nm').'" ваш профиль создан</h4>Пожалуйста войдите'.VariablesController::$bsa;

        return redirect('/index')->with('error', $error);
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Slb;
use App\User;

class MysqlRequests extends Controller
{
    public static function programm() {

        $y = VariablesController::timeSet()['now'];
        $slba = VariablesController::$slba;

        if (request()->has('chdt'))
        {
            $chd = request()->chdt;
            $y = new \DateTime($chd);
        }

        if ($y->format('N') > 5)
            array_splice($slba, 2,1);
        
        for ($i = 0; $i < count($slba); ++$i) {													// 7 служб в течение дня
            $c = $slba[$i];						//задаём очерёдность служб в массиве day по времени в течение дня
            $day[$i] = User::join('slbs', 'users.id', '=', 'slbs.user_id')
                ->join('brahs', 'users.id', '=', 'brahs.user_id')
                ->select('users.name','brahs.sname','slbs.slba','slbs.stts','slbs.user_id')
                ->where( 'date', $y->format('Y-m-d'))
                ->where( 'slbs.slba', $c)
                ->whereNotIn('users.right', ['adm', 'out'])
                ->orderBy('slbs.user_id', 'asc')
                ->get();                            // задаём очерёдность id брахмачари в массиве day по возрастанию
        }
        $row1 = User::join('brahs', 'users.id', '=', 'brahs.user_id')
            ->whereNotIn('users.right', ['adm', 'out'])
            ->select('users.name','brahs.sname','users.id','users.right')
            ->orderBy( 'users.id', 'asc')
            ->get();                                //составляем массив day1 из имён брахмачари по возрастанию id

        for ($j = 0; $j < count($row1); $j++)
        {
            if ($row1[$j]->sname !== NULL)
                $row1[$j]->name = $row1[$j]->sname;
            unset($row1[$j]->sname);
        }

        $alrt = Slb::where('date', $y->format('Y-m-d'))
            ->where('user_id', session('id'))
            ->select('user_id')
            ->get();

        return compact('day', 'row1', 'alrt');
    }
}
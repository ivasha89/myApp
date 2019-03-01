<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MysqlRequests extends Controller
{
    public function programm(Request $request) {

        $y = VariablesController::time_set()->now;

        if ($request->has('chdt'))
        {
            $chd = $request->chdt;
            $y = new \DateTime($chd);
        }

        if ($y->format('N') > 5)
            array_splice($slba, 2,1);
        
        for ($i = 0; $i < count($slba); ++$i) {													// 7 служб в течение дня
            $c = $slba[$i];						//задаём очерёдность служб в массиве day по времени в течение дня
            $day[$i] = DB::table('users')
                ->join('slbs', 'users.id', '=', 'slbs.user_id')
                ->join('brahs', 'users.id', '=', 'brah.user_id')
                ->select('users.name','users.sname','slbs.slba','slbs.stts','slbs.user_id')
                ->where( 'date', $y->format('Y-m-d'))
                ->where( 'slbs.slba', $c)
                ->whereIn('users.right', ['adm', 'out'])
                ->orderBy('slbs.user_id', 'asc')
                ->get();                            // задаём очерёдность id брахмачари в массиве day по возрастанию
        }
        $day1 = DB::table('users')
            ->join('brahs', 'users.id', '=', 'brahs.user_id')
            ->whereNotIn('users.right', ['adm', 'out'])
            ->select('brahs.name','brahs.sname','users.id','users.right')
            ->orderBy( 'users.id', 'asc')
            ->get();                                //составляем массив day1 из имён брахмачари по возрастанию id

        foreach ($day1 as $rowd) //массив брахмачари
        {
            $row1[] = $rowd;
        }
        
        for ($j = 0; $j < count($row1); $j++) 
        {
            if ($row1[$j]['sname'] !== '')
                $row1[$j]['name'] = $row1[$j]['sname'];
            unset($row1[$j]['sname']);
        }
        
        $alrt = DB::table('slbs')
            ->where('date', $y->format('Y-m-d'))
            ->where('user_id', $_SESSION['id'])
            ->select('user_id')
            ->get();
        return compact('day', 'row1', 'alrt');
    }
}
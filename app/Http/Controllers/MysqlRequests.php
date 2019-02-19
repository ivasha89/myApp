<?php

namespace БСШСА\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MysqlRequests extends Controller
{
    public function programm() {

        $y = $now;
        if (isset($_POST['chdt'])){
            $chd = 'chdt';
            $ch = {{ $chd }};
            $y = new \DateTime(".$ch.");
        }
        if ($y->format('N') > 5)
            array_splice($slba, 2,1);
        for ($i = 0; $i < count($slba); ++$i) {													// 7 служб в течение дня
            $c = $slba[$i];						//задаём очерёдность служб в массиве day по времени в течение дня
            $day[$i] = DB::table('users')
                ->join('slbs', 'users.ids', '=', 'slbs.idbr')
                ->join('brahs', 'users.ids', '=', 'brah.ids')
                ->select('users.name','users.sname','slbs.slba','slbs.stts','slbs.idbr')
                ->where( 'date', '=', $y->format('Y-m-d'))
                ->where( 'slbs.slba', '=', $c)
                ->where('users.rights', '!=', 'adm')
                ->orderBy('slbs.idbr')
                ->get();                            // задаём очерёдность id брахмачари в массиве day по возрастанию
        }
        $day1 = DB::table('users')
            ->join('brahs', 'users.ids', '=', 'brahs.ids')
            ->where('rights','!=','adm')
            ->select('brahs.name','brahs.sname','users.ids','users.rights'
            ->orderBy( 'users.ids')
            ->get();                                //составляем массив day1 из имён брахмачари по возрастанию id

        foreach ($day1 as $rowd1)								//массив брахмачари
            $row1[] = $rowd1;
        for ($j = 0; $j < count($row1); $j++) {
            if ($row1[$j]['sname'] !== '')
                $row1[$j]['name'] = $row1[$j]['sname'];
            unset($row1[$j]['sname']);
        }
        $alrt = DB::table('slbs')
            ->where('date','=', $y->format('Y-m-d'))
            ->where('idbr','=', $_SESSION['id'])
            ->get('idbr');
        return(compact($day, $row1, $alrt))
    }
}

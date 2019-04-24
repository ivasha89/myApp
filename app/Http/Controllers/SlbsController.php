<?php

namespace App\Http\Controllers;

use App\Slb;
use App\User;
use DateTime;
use Illuminate\Http\Request;

class SlbsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $test1 = new VariablesController();
        $now = (new DateTime)->format('Y-m-d');
        $y = $test1::timeSet()['now'];
        $nextDay = (new DateTime())->modify('+1 day')->format('Y-m-d');
        $previousDay = (new DateTime())->modify('-1 day')->format('Y-m-d');
        $days = $test1::$days;
        $months = $test1::$months;
        $currentSlb = $test1::timeSet()['slb'];
        $slba = $test1::$slba;
        $stts = $test1::$stts;

        if (request()->has('changeDate')) {
            session()->forget('date');
            request()->session()->put('date', request()->changeDate);
        }
        //dd(request()->changeDate, request()->mode);
        if (session()->has('date')) {
            $changeDate = session('date');
            $y = new DateTime($changeDate);
            $nextDay = (new DateTime($changeDate))->modify('+1 day')->format('Y-m-d');
            $previousDay = (new DateTime($changeDate))->modify('-1 day')->format('Y-m-d');
        }

        if ($y->format('N') > 5)
            array_splice($slba, 2, 1);

        for ($i = 0; $i < count($slba); ++$i) {
            $c = $slba[$i];
            $day[$i] = Slb::join('users', 'slbs.user_id', '=', 'users.id')
                ->select('slbs.slba', 'slbs.stts', 'slbs.user_id')
                ->where('slbs.date', $y->format('Y-m-d'))
                ->where('slbs.slba', $c)
                ->whereNotIn('users.right', ['adm', 'out'])
                ->orderBy('slbs.user_id', 'asc')
                ->get();
        }

        /*$users = User::whereNotIn('right', ['adm', 'out'])
            ->select('name', 'right','id')
            ->orderBy('id', 'asc')
            ->get();*/

        $test = new MysqlRequests();
        $rw1 = $test::programm()['row1'];
        $alrt = $test::programm()['alrt'];

        for ($i = 0; $i < count($slba); ++$i) {                                        //получаем 3-ёх мерный
            $row[$i] = $day[$i]->toArray();
            for ($j = 0; $j < count($rw1); ++$j) {
                $row1[$j] = $rw1[$j]->toArray();
                if (!isset($row[$i])) {                              //создаём массив одной службы
                    $row[$i][$j]['slba'] = $slba[$i];                        //на этой службе никто не отметился
                    $row[$i][$j]['stts'] = '❌';
                    $row[$i][$j]['user_id'] = $row1[$j]['id'];
                } elseif (count($row[$i]) !== count($row1)) {                    //если на службе отметились не все
                    if (!isset($row[$i][$j]['user_id'])) {                            //брахмачари - создаём пустые
                        $row[$i][$j]['name'] = $row1[$j]['name'];                //статусы для неотметившихся
                        $row[$i][$j]['slba'] = $slba[$i];
                        $row[$i][$j]['stts'] = '❌';
                        $row[$i][$j]['user_id'] = $row1[$j]['id'];
                    } elseif ((int)$row[$i][$j]['user_id'] !== $row1[$j]['id']) {
                        $arr = ['name' => $row1[$j]['name'], 'slba' => $slba[$i], 'stts' => '❌', 'user_id' => $row1[$j]['id']];
                        array_unshift($row[$i], $arr);
                        foreach ($row[$i] as $key => $val)                          //создаём пустой статус для
                            $id[$key] = $val['user_id'];                           //неотметившихся брахмачари
                        array_multisort($id, SORT_ASC, $row[$i]);                    //и смещаем отметившихся
                        unset($id);                                              //брахмачари по убыванию id
                    }
                }
            }
        }

        if (session()->has('mode')) {
            $mode = null;
            session()->forget('mode');
        }
        else {
            request()->session()->put('mode', request()->mode);
            $mode = session('mode');
        }

            return view('slbs.table', compact('stts','row', 'slba', 'alrt', 'y', 'days', 'months', 'row1', 'currentSlb', 'mode', 'now', 'nextDay', 'previousDay'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $y = VariablesController::timeSet()['now'];
        $slb = $this::index()['currentSlb'];
        if ($request->statusNumber) {
            $request->validate([
                'status' => ['gte: 1','lt: 17']
            ]);
            $var4 = $request->statusNumber;
        }
        else
            $var4 = $request->status;

        if ($slb) {
            $var1 = session('id');
            $var2 = $y->format('Y-m-d');
            $var3 = $request->slba;
        }
        else{
            $var1 = $request->id;
            $var2 = $request->date;
            $var3 = $request->sluzhba;
        }

        if ($request->has('delete'))
            MyFunctions::delete($var1, $var2, $var3);
        else
            MyFunctions::updateOrInsert($var1, $var2, $var3, $var4);

        return redirect('/slbs');
    }

    public function statistics()
    {
        $test = new VariablesController();
        $dateEnd = new DateTime();
        $dateStart = new DateTime();
        $stts = $test::$stts;
        $slba = $test::$slba;
        $slbs = $slba;
        array_splice($slbs, 1, 1);

        $dzhapaStatuses = [
            'c' => 16, 'n' => 0, '-' => 16, 'b' => 16, '/' => 16
        ];

        $row1 = MysqlRequests::programm()['row1'];
        $days = $this->index()['days'];
        $months = $this->index()['months'];
        $diff = 7;
        $dateStart->modify("-8 day");

        if (request()->has('dateStart')) {
            $dateStart = (new DateTime(request()->dateStart))->modify('-1 day');
            $dateEnd = new DateTime(request()->dateEnd);
            $diff = $dateEnd->diff($dateStart)->d;
        }

        $weekEndDays = 0;
        for ($i = 0; $i < $diff; ++$i) {
            $date[$i] = new DateTime($dateStart->modify('+1 day')->format('Y-m-d'));
            if($date[$i]->format('N') == 6 or $date[$i]->format('N') == 7)
                $weekEndDays = $weekEndDays + 1;
            if (($dateEnd->diff($date[$i])->d) == 0) {
                break;
            }
        }
        $yogaDays = $diff - $weekEndDays;

        $userId = User::whereNotIn('users.right', ['adm', 'out'])->select('id')->get()->toArray();
        for ($i = 0; $i < count($userId); ++$i )
            $id[$i] = $userId[$i]['id'];

        for ($j = 0; $j < count($id); ++$j) {
            for ($i = 0; $i < count($slbs); ++$i) {
                for ($k = 0; $k < count($date); ++$k) {
                    $status = Slb::where('date', $date[$k]->format('Y-m-d'))
                        ->where('slba', $slbs[$i])
                        ->where('user_id', $id[$j])
                        ->select('stts')
                        ->get()
                        ->toArray();
                    if ($status){
                        $statuses[$j][$i][$k] = $status['0']['stts'];
                        foreach($stts as $key => $stt){
                            if ($status['0']['stts'] == $key)
                                $day[$j][$i][$k] = $stt;
                        }
                    }
                    else {
                        $day[$j][$i][$k] = 0;
                        $statuses[$j][$i][$k] = '❌';
                    }
                    $dzhapa = Slb::where('date', $date[$k]->format('Y-m-d'))
                        ->where('slba', 'ДЖ')
                        ->where('user_id', $id[$j])
                        ->select('stts')
                        ->get()
                        ->toArray();
                    if ($dzhapa) {
                        if (!(int)$dzhapa['0']['stts']) {
                            $statuses[$j][6][$k] = $dzhapa['0']['stts'];
                            foreach ($dzhapaStatuses as $key => $stt) {
                                if ($dzhapa['0']['stts'] == $key) {
                                    $day[$j][6][$k] = $stt;
                                }
                            }
                        } else {
                            $day[$j][6][$k] = (int)$dzhapa['0']['stts'];
                            $statuses[$j][6][$k] = (int)$dzhapa['0']['stts'];
                        }
                    }
                    else {
                        $day[$j][6][$k] = 0;
                        $statuses[$j][6][$k] = '❌';
                    }

                    if ($slbs[$i] == 'ЙГ') {
                        if ($yogaDays == 0)
                            $a[$j][$i] = '❌';
                        else
                            $a[$j][$i] = (int)(array_sum($day[$j][$i]) / $yogaDays * 100);
                    }
                    else
                        $a[$j][$i] = (int)(array_sum($day[$j][$i]) / $diff * 100);

                    $a[$j][6] = (int)(array_sum($day[$j][6]) / 16 / $diff * 100);
                }
                $iArr[$i] = $i;
                if ($i == 5)
                    $iArr[6] = 6;
            }
            array_multisort($iArr, SORT_ASC, $day[$j]);
            array_multisort($iArr, SORT_ASC, $a[$j]);
            array_multisort($iArr, SORT_ASC, $statuses[$j]);
        }

        return view('slbs.stats',compact('a', 'row1', 'slba', 'statuses', 'months', 'days', 'date', 'diff', 'dateStart', 'dateEnd'));
    }
}

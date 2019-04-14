<?php

namespace App\Http\Controllers;

use App\Slb;
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
        $y = $test1::timeSet()['now'];
        $now = $y->format('Y-m-d');
        $days = $test1::$days;
        $monthes = $test1::$monthes;
        $currentSlb = $test1::timeSet()['slb'];
        $slba = $test1::$slba;
        $stts = $test1::$stts;
//dd(session('date'));
        if (request()->has('changeDate')) {
            session()->forget('date');
            request()->session()->put('date', request()->changeDate);
        }

        if (session()->has('date')) {
            $changeDate = session('date');
            $y = new DateTime($changeDate);
        }

        if ($y->format('N') > 5)
            array_splice($slba, 2, 1);

        /*$users = User::whereNotIn('right', ['adm', 'out'])
            ->select('name', 'right','id')
            ->orderBy('id', 'asc')
            ->get();*/

        $test = new MysqlRequests();
        $rw1 = $test::programm()['row1'];
        $alrt = $test::programm()['alrt'];
        $rw = $test::programm()['day'];

        for ($i = 0; $i < count($slba); ++$i) {                                        //получаем 3-ёх мерный
            $row[$i] = $rw[$i]->toArray();
            for ($j = 0; $j < count($rw1); ++$j) {
                $row1[$j] = $rw1[$j]->toArray();
                if (isset($row[$i][$j]['sname'])) {                             //заменяем имя духовным именем
                    $row[$i][$j]['name'] = $row[$i][$j]['sname'];               //если духовное имя есть
                }
                unset($row[$i][$j]['sname']);
                if (!isset($row[$i])) {                              //создаём массив одной службы
                    $row[$i][$j]['name'] = $row1[$j]['name'];                        //с пустыми статусами, если
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

            return view('slbs.table', compact('stts','row', 'slba', 'alrt', 'y', 'days', 'monthes', 'row1', 'currentSlb', 'mode', 'now'));
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

    }
}

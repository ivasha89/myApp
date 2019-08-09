<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $test1 = new VariablesController();
        $y = $test1::timeSet()['now'];
        $days = $test1::$days;
        $months = $test1::$months;

        $users = User::whereNotIn('right', ['adm', 'out'])
            ->orderBy('id', 'asc')
            ->get();

        for ($i = 0; $i < 10; $i++) {
            $rules[$i] = DB::table('rules')
                ->select('service', 'id')
                ->get()[$i];
        }

        return view('services.index', compact('months','days', 'y', 'users', 'rules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Service::create([
            'rule_id' => $request->service,
            'user_id' => $request->id,
            'dateToServe' => $request->date
        ]);

        return redirect('/services');
    }

    public function statistics()
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $test1 = new VariablesController();
        $stts = $test1::$stts;
        $currentSlb = $test1::timeSet()['slb'];
        $alrt = MysqlRequests::programm()['alrt'];
        $slba = $test1::$slba;
        $y = $test1::timeSet()['now'];
        $days = $test1::$days;
        $months = $test1::$months;

        $test = new SlbsController();
        $userStatuses = $test::statistics()['userStatuses'];
        $userAttendance = $test::statistics()['userAttendance'];
        $date = $test::statistics()['date'];


        $doneProjects = $user->projects()->where('finished', true)->get();
        foreach ($doneProjects as $project) {
            $project->date = (new \DateTime($project->expire_at))->getTimestamp() - (new \DateTime())->getTimestamp();
            if ($project->date > 0)
                $project->day = (new \DateTime($project->expire_at))->diff(new \DateTime())->days;
        }
        $ongoingProjects = $user->projects()->where('finished', false)->get();
        foreach ($ongoingProjects as $project) {
            $project->date = (new \DateTime($project->expire_at))->getTimestamp() - (new \DateTime())->getTimestamp();
            if ($project->date > 0)
                $project->day = (new \DateTime($project->expire_at))->diff(new \DateTime())->days;
        }

        $daysInAshram = (integer)((new \DateTime("$user->created_at"))->diff(new \DateTime('now'))->days);
        $dzhapa = $user->slbs()->where('slba', 'ДЖ')->select('stts')->get();
        $dzhapaFiltered = $dzhapa->filter(function ($value, $key) {
            return $value->stts > 1;
        });
        foreach ($dzhapaFiltered as $dzhapaFilt) {
            $dzhapaArray[] = $dzhapaFilt->toArray()['stts'];
        }

        if (isset($dzhapaArray))
            $allDzhapa = array_sum($dzhapaArray);
        else
            $allDzhapa = 0;

        if(($y->format('m') < '08') && ($y->format('d') < '26'))
            $yearId = (int)($y->format('y') . '00') - 100;
        else
            $yearId = (int)($y->format('y') . '00');

        return view('user.page', compact('user', 'daysInAshram', 'allDzhapa', 'stts', 'currentSlb', 'alrt', 'doneProjects', 'ongoingProjects', 'slba', 'y', 'days', 'months', 'userAttendance', 'date', 'userStatuses', 'yearId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        auth()->user()->update([
            'lastSeen_at' => $request->lastSeen_at
        ]);
        return ['status' => 'lastSeen status updated!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

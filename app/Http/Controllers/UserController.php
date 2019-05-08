<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
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

        $stts = VariablesController::$stts;
        $currentSlb = VariablesController::timeSet()['slb'];
        $alrt = MysqlRequests::programm()['alrt'];

        $projects = $user->projects;

        return view('user.page', compact('user', 'daysInAshram', 'allDzhapa', 'stts', 'currentSlb', 'alrt', 'projects'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $projects = $user->projects;
        $this->authorize('view', $user);
        return view('projects.index', compact('projects', 'user'));
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

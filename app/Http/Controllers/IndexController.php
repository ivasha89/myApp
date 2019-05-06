<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function user(User $user)
    {
        $id = str_split($user->id, 2);
        $idYear = '20'.$id[0].'-07-25';
        $daysInAshram = (integer)((new \DateTime("$idYear"))->diff(new \DateTime('now'))->days);
        $dzhapa = $user->slbs()->where('slba', 'ДЖ')->select('stts')->get();
        $dzhapaFiltered = $dzhapa->filter(function ($value, $key) {
            return $value->stts > 1;
        });
        foreach($dzhapaFiltered as $dzhapaFilt) {
            $dzhapaArray[] = $dzhapaFilt->toArray()['stts'];
        }
        $allDzhapa = array_sum($dzhapaArray);
        $stts = VariablesController::$stts;
        $currentSlb = VariablesController::timeSet()['slb'];
        $alrt = MysqlRequests::programm()['alrt'];

        $this->authorize('view', $user);

        return view('user.page', compact('user', 'daysInAshram', 'allDzhapa', 'stts', 'currentSlb', 'alrt'));
    }

    public function index()
    {
        $user = auth()->user();
        session()->forget('token');
        $this->sessionData();
        return view('index', compact('user'));
    }

    public static function sessionData()
    {
        if (auth()->user() && !session('name')) {
            session()->put('name', auth()->user()->name);
            session()->put('id', auth()->user()->id);
            session()->put('right', auth()->user()->right);
        }
    }
}

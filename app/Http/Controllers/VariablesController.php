<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class VariablesController extends Controller
{
    static $appname = 'БСШСА',

        $monthes = [
            '','Января', 'Февраля', 'Марта',
            'Апреля', 'Мая', 'Июня',
            'Июля', 'Августа', 'Сентября',
            'Октября', 'Ноября', 'Декабря'
        ],

        $days = [
            '','Пн', 'Вт', 'Ср',
            'Чт', 'Пт', 'Сб', 'Вс'
        ],

        $slba = [
            'МА', 'ДЖ', 'ЙГ', 'ПБ', 'ГП', 'ШБ', 'ГА'
        ],

        $stts = [
            '+', 'o', 'n', 'c', '-', 'b', '/'
        ];

    public static function init()
    {
        if (session('name')) {
            $loggedin = TRUE;
            $user = session('name');
            $usrstr = $user;
        } else {
            $usrstr = '(Гость)';
            $loggedin = FALSE;
        }
        $usr = [
        	'frst' => $usrstr, 
        	'scnd' => $loggedin
        	];
        return $usr;
    }

    public static function timeSet()
    {
        $now = new DateTime(date('Y-m-d H:i:s'));
        $ma = new DateTime('04:30:00'); //дата с которой отчитываем
        $dz = new DateTime('6:00:00');
        $pb = new DateTime('14:45:00');
        $ga = new DateTime('18:00:00');
        $diff0 = $now->getTimestamp() - $ma->getTimestamp();
        $diff1 = $now->getTimestamp() - $dz->getTimestamp();
        $diff2 = $now->getTimestamp() - $pb->getTimestamp();
        $diff3 = $now->getTimestamp() - $ga->getTimestamp();
        if (($diff0 < 300) && (-$diff0 < 1200))
            $slb = 'МА';
        elseif (abs($diff1) < 3900)
            $slb = 'ДЖ';
        elseif (($diff2 < 300) && (-$diff2 < 1200))
            $slb = 'ПБ';
        elseif (($diff3 < 300) && (-$diff3 < 1200))
            $slb = 'ГА';
        else $slb = null;

        return compact('now', 'slb');
    }
}
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
        ],

        $asa = "<div class='container text-center mb-2'><a class='btn btn-warning'",

        $bsa = "</a></div>";

    public static function init()
    {
        if (isset($_SESSION['name'])) {
            $loggedin = TRUE;
            $user = $_SESSION['name'];
            $usrstr = $user;
        } else {
            $usrstr = '(Гость)';
            $loggedin = FALSE;
        }
        $usr = ['frst' => $usrstr, 'scnd' => $loggedin];
        return $usr;
    }

    public static function time_set()
    {
        $now = new DateTime(date('Y-m-d H:i:s'));
        $ma = new DateTime('04:30:00'); //дата с которой отчитываем
        $dz = new DateTime('06:00:00');
        $pb = new DateTime('7:45:00');
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
        else $slb = '';

        return compact('now', 'slb');
    }

}

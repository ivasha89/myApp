<?php

namespace БСШСА\Http\Controllers;

use Illuminate\Http\Request;
use БСШСА\User;
use БСШСА\Brah;
use Illuminate\Support\Facades\DB;

class InterController extends Controller
{
    public function signup() {

        if (!isset($error))
            $error = 'Вы не заполнили ни одного поля';
        $hj = FALSE;
        if (isset($_POST['psrd'])) {
            $psrd = $_POST->psrd;
            $salt1 = "gi^r";
            $salt2 = "w&(v";
            $tkn = hash('ripemd128', "$salt1$psrd$salt2");

            $rslt = DB::table('users')
                ->where('pssw', '=', $tkn)
                ->select('pssw')
                ->get();
            $rw = $rslt->count();
            if ($rw == 0) {
                $a = ["Неверно ввели", "Ошибка ввода", "Снова мимо", "Беда какая-то", "Неповезло. День Сатурна", "Узнать у астролога пароль", "Может вы на сайте другого ашрама?", "Переключить раскладку на английский"];
                die($asa . "href=\"{{ url('signup') }}\"" . $a[array_rand($a, 1)] . $bsa);
            }
            elseif ($rw !== 0) {
                $row = $rslt;
                if ($tkn == $row)
                    $hj = TRUE;
            }
        }

        if (isset($_SESSION['user'])) MyFunctions::destroySession();

        if (isset($_POST['id'])) {
            $pss = $_POST->ps;
            $nme = $_POST->nm;
            $snm = $_POST->sn;
            $idy = $_POST->id;
            $rts = $_POST->rt;

            if ($pss == "" && $nme == "" && $idy == "")
                $error = "Обязательные поля не были заполнены";
            else {
                $result = DB::table('brahs')
                    ->where('name','=', $nme)
                    ->get();
                $rw = $result->count();
                if ($rw)
                    $error = "Такой пользователь уже существует";
                else {
                    $error = "Успешно";
                    $ps = $pss;
                    $rt = $rts;
                    $id = $idy;
                    $nm = $nme;
                    $sn = $snm;
                    $salt1 = "gi^r";
                    $salt2 = "w&(v";
                    $tkn = hash('ripemd128', "$salt1$ps$salt2");

                    $user = new User();
                    $user->ids = $id;
                    $user->pssw = $tkn;
                    $user->right = $rt;
                    $user->save();

                    if (!$result) $error = "Ошибка в отправке пароля или ID";

                    $brah = new Brah;
                    $brah->name = $nm;
                    $brah->sname = $sn;
                    $brah->tel = '';
                    $brah->city = '';
                    $brah->ids = $id;
                    $brah->save();

                    die($asa."href="\{{ url('login') }}\"><h4>Дорогой бхакта, "\$nme\" ваш профиль создан</h4>Пожалуйста войдите"\$bsa);
                }
            }
        }

        return view('signup', compact('error', 'hj'));
    }
}

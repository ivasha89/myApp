<?php

namespace БСШСА\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class myFunctions extends Controller
{

    public static function destroySession() {

         $_SESSION = [];
         if (session_id() != "" || isset($_COOKIE[session_name()]))
             setcookie(session_name(), '', time() - 60*60*24*3, '/');
         session_destroy();
     }

    public static function search($var1) {

        $var1 = {{ $var1 }};
        $queryz = '';
        $arraysearch = explode (",", $var1);
        switch ($_POST['srch']) {
             case 'name':
                 foreach($arraysearch as $key => $value) {
                     if (isset($arraysearch[$key - 1])) {$queryz .= ' OR '; $value = trim($value, " ");}
                     $queryz .= '`name` LIKE "%'.$value.'%"';
                 }
                 $query = "SELECT name,date  FROM brah,slb WHERE $queryz and brah.id=slb.id";
                 break;
             case 'sign':
                 foreach($arraysearch as $key => $value) {
                     if (isset($arraysearch[$key - 1])) {$queryz .= ' OR '; $value = trim($value, " ");}
                     $queryz .= '`stts` LIKE "%'.$value.'%"';
                 }
                 $query = "SELECT * FROM slb WHERE $queryz ";
                 break;
             default:
                 $error = 'Выберите тип поиска';
                 break;
         }
         global $conn;
         $res = $conn->query($query);
         if (!$res)
             return false;
         $conn->close();
         return $res;
    }

    public static function slbcreate($conn, $var1, $var2, $var3, $var4) {		// Функция создания новой записи в таблице

         global $error;
         if (is_array($var1)) {													//создание администратором
             for ($i = 0; $i < count($var1); $i++) {									//множества записей
                 if (is_array($var3)) {
                     for ($j = 0; $j < count($var3); $j++) {
                         $RawExists = DB::table('slbs')
                             ->where('idbr','=', $var1[$i])
                             ->where('date', '=', $var2)
                             ->where('slba','=', $var3[$j])
                             ->count();
                         if ($RawExists == 0) {
                             DB::table('slbs')
                                 ->insertGetId(
                                     ['name' => $var1[$i], 'date' => $var2, 'slba' => $var3[$j], 'stts' => $var4]
                                 );
                         }
                     }
                 }
             }
         }
        $RawExist = DB::table('slbs')
            ->where('idbr','=', $var1)
            ->where('date', '=', $var2)
            ->where('slba','=', $var3)
            ->count();
        if ($RawExist == 0) {
            DB::table('slbs')
                ->insertGetId(
                    ['name' => $var1, 'date' => $var2, 'slba' => $var3, 'stts' => $var4]
                );
        }
         else
             $error = "Вы уже отметились";

         if ($conn->error or $conn->connect_error)
             $error = "Не удалось вставить данные: " . $conn->error;
     }

    public static function slbupdate($conn, $var1, $var2, $var3, $var4) {			// Функция обновления данных таблицы

         global $error;
         if (is_array($var1)) {												//обновление администратором
             for ($i = 0; $i < count($var1); $i++) {									//множества записей
                 if (is_array($var3)) {
                     for ($j = 0; $j < count($var3); $j++)
                         $conn->query("UPDATE slb SET stts='$var4' WHERE idbr='".$var1[$i]."' and date='$var2' and slba='".$var3[$j]."'");
                 }
                 else
                     $conn->query("UPDATE slb SET stts='$var4' WHERE idbr='".$var1[$i]."' and date='$var2' and slba='$var3'");
             }
         }
         else {																	//обновление для брахмачари
              $conn->query("UPDATE slb SET stts='$var4' WHERE idbr='$var1' and date='$var2' and slba='$var3'");
              $error = "Осталось несколько попыток обновления";
         }
         if ($conn->error or $conn->connect_error)
             $error = "Не удалось обновить запись" . $conn->error;
     }


    public static function slbdelete($conn, $var1, $var2, $var3) {							// Функция удаления данных

         global $error;
         if (is_array($var1)) {													//удаление администратором
             for ($i = 0; $i < count($var1); $i++) {								//множества записей
                 if (is_array($var3)) {
                     for ($j = 0; $j < count($var3); $j++) {
                         if (mysqli_num_rows($conn->query("SELECT * FROM slb WHERE idbr='".$var1[$i]."' and date='$var2' and slba='".$var3[$j]."'")) !== 0)
                             $conn->query("DELETE FROM slb WHERE idbr='".$var1[$i]."' and date='$var2' and slba='".$var3[$j]."' ");
                     }
                 }
                 elseif (mysqli_num_rows($conn->query("SELECT * FROM slb WHERE idbr='".$var1[$i]."' and date='$var2' and slba='$var3'")) !== 0)
                     $conn->query("DELETE FROM slb WHERE idbr='".$var1[$i]."' and date='$var2' and slba='$var3' ");
             }
         }
         elseif (mysqli_num_rows($conn->query("SELECT * FROM slb WHERE idbr='$var1' and date='$var2' and slba='$var3'")) !== 0)														//удаление для брахмачари
             $conn->query("DELETE FROM slb WHERE idbr='$var1' and date='$var2' and slba='$var3'");
         else $error = "Полубоги уже удалили ваши данные";

         if ($conn->error or $conn->connect_error)
             $error = "Не удалось удалить запись: " . $conn->error;
     }
}

<?php
session_start();
ini_set("display_errors", "stderr");
date_default_timezone_set('UTC');
error_reporting(E_ALL);

$expire = time() + 60 * 60 * 24 ; //1day
$myfile = fopen("./dumps.txt", "w") or die("Unable to open file!");
#var_dump($GLOBALS);
#$data = ob_get_clean();
#fwrite($myfile, $data);

setcookie("clicked",  "yes", $expire);
//if (isset($_COOKIE['basic'])){
    //$basic = json_decode($_COOKIE['basic']);
$pos = $_GET['pos'];
$tget = $_GET['t'];
$dt = new DateTime("@$tget"); // convert UNIX timestamp to PHP DateTime
$t  = $dt->format('m/d/Y, h:i:s A');


#    $t = date("m/d/Y, h:i:s A");
$action = 'click link';

if(isset($_COOKIE['user_action'])){
    $array =json_decode($_COOKIE['user_action']);
    $arr = [$pos, $action, $t];
    array_push($array,$arr);
    setcookie("user_action",  json_encode($array), $expire);
}else{
    $tamp = [$pos, $action, $t];
    $array = [$tamp];
    setcookie("user_action",  json_encode($array), $expire);
}




//    $insert_action = $db_connection->prepare("INSERT INTO serp.user_action (exp_id, user_id, action, link_id, date) VALUES(?,?,?,?,?);");
//    $str1 = "test";
//    $insert_action->bind_param("sssss", $str1, $str1, $action, $pos, $t);
//    $insert_action->execute();
//    $insert_action->close();
//}
?>


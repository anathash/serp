<?php

include 'db_vars.php';
ini_set("display_errors", "stderr");
date_default_timezone_set('UTC');
error_reporting(E_ALL);

$debug = true;
$DATABASE = 'serp';

$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

$myfile = fopen("./dumps.txt", "w") or die("Unable to open file!");
#var_dump($GLOBALS);
#$data = ob_get_clean();
#fwrite($myfile, $data);

$expire = time() + 60 * 60 * 24 ; //1day

if (!empty($_COOKIE["user"])){
//    if(isset($_COOKIE['knowledge'])&&$_COOKIE['knowledge'] == "yes"){
//        setcookie("knowledge", "");
//        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
//        $len = strlen($str)-1;
//        $random_str = '';
//        for ($i=0;$i<8;$i++) {
//            $num=mt_rand(0,$len);
//            $random_str .= $str[$num];
//        }
//
//        $zero = 0;
//        $time = "N/A";
//        $feedback = "knowledge exist";
//
//        $insert_basic = $db_connection->prepare("INSERT INTO serp.exp_data (exp_id, user_id, test_url, window_width, window_height, query, sequence, start, end, feedback)VALUES(?,?,?,?,?,?,?,?,?,?);");
//        $insert_basic->bind_param("ssssssssss", $random_str, $_COOKIE["user"], $_COOKIE["url"], $zero, $zero,$_COOKIE["query"],$_COOKIE["sequence"], $time, $time, $feedback);
//        $insert_basic->execute();
//
//    } else
//    if (isset($_COOKIE['basic'])&&isset($_COOKIE['user_action'])&&isset($_COOKIE['user_view'])&&isset($_POST['feedback'])&&isset($_COOKIE['knowledge'])){
//    if (isset($_COOKIE['basic'])&&isset($_COOKIE['user_action'])&&isset($_POST['feedback'])&&isset($_COOKIE['knowledge'])){
    if (isset($_COOKIE['basic'])){
        setcookie("knowledge", "");
        $basic = json_decode($_COOKIE['basic']);
//        $mouse_movement = json_decode($_COOKIE['mouse_movement']);

//        $user_view = json_decode($_COOKIE['user_view']);

//        foreach ($mouse_movement as $postion){
//            $insert = $db_connection->prepare("INSERT INTO  serp.user_mouse (exp_id, user_id, x, y, date)VALUES( ?, ?, ?, ?, ?)");
//            $insert->bind_param("sssss", $basic[1], $basic[0], $postion[0], $postion[1], $postion[2]);
//            $insert->execute();
//        }

		#$start_time =  date('m/d/Y, h:i:s A', $basic[3]);
		#$end_time =   date('m/d/Y, h:i:s A', $basic[4]);
		$dt = new DateTime("@$basic[3]"); // convert UNIX timestamp to PHP DateTime
		//$start_time  = $dt->format('m/d/Y, h:i:s A');
		$start_time  = $dt->format('Y-m-d H:i:s');
		//$dt = new DateTime("@$basic[4]"); // convert UNIX timestamp to PHP DateTime
		$etc = json_decode($_COOKIE['end_time']);
		$dt = new DateTime("@$etc"); // convert UNIX timestamp to PHP DateTime
		$end_time  = $dt->format('Y-m-d H:i:s');
		//$end_time  = $dt->format('m/d/Y, h:i:s A');

		$knowledge='';
		if (isset($_COOKIE['knowledge'])){
			$knowledge=$_COOKIE['knowledge'];
		}


        $insert_basic = $db_connection->prepare("INSERT INTO serp.exp_data (exp_id, user_id, test_url, window_width, window_height, query, sequence, start, end, knowledge, feedback, reason, treatment, problem, comments, ad_exp_effect, ad_dec_effect, ad_comments )VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
        $insert_basic->bind_param("ssssssssssssssssss", $basic[0], $_COOKIE["user"], $_COOKIE["url"], $basic[1], $basic[2],$_COOKIE["query"],$_COOKIE["sequence"], $start_time, $end_time, $knowledge, $_POST['feedback'], $_POST['reason'],$_POST['treatment'],$_POST['condition'], $_POST['ad_comment'], $_POST['exp'], $_POST['dec'], $_POST['ad_comments']);
        $insert_basic->execute();


        $update_used = $db_connection->prepare("UPDATE serp.config_data SET answered = answered + 1 WHERE URL = ?");
        $update_used->bind_param("s", $_COOKIE["url"]);
        $update_used->execute();

        #$t = date("m/d/Y, h:i:s A");
        $i1 = 0;
        $str1 = "close page";
		$cpt = json_decode($_COOKIE['close_page']);
		$dt = new DateTime("@$cpt"); // convert UNIX timestamp to PHP DateTime
		#$close_page = $dt->format('m/d/Y, h:i:s A');
		$close_page  = $dt->format('Y-m-d H:i:s');

        $insert_action = $db_connection->prepare("INSERT INTO serp.user_action(exp_id, user_id, action, link_id, date)VALUES(?,?,?,?,?)");
        $insert_action->bind_param("sssss", $basic[0], $_COOKIE["user"], $str1, $i1,  $close_page);
        $insert_action->execute();

		 if (isset($_COOKIE['user_action'])){
			$user_action = json_decode($_COOKIE['user_action']);
			foreach ($user_action as $action){
			//            if ($action[1] == "close_page"){
			//                $insert_action = $db_connection->prepare("INSERT INTO serp.user_action(exp_id, user_id, action, link_id, date)VALUES(?,?,?,?,?)");
			//                $insert_action->bind_param("sssss", $basic[0], $_COOKIE["user"], $action[1], $action[0], $action[2]);
			//                $insert_action->execute();
			//
			//                $update_action = $db_connection->prepare("UPDATE serp.exp_data SET end = ? WHERE exp_id = ?");
			//                $update_action->bind_param("ss",$action[2], $basic[1]);
			//                $update_action->execute();
			//            }else{
					$insert_action = $db_connection->prepare("INSERT INTO serp.user_action(exp_id, user_id, action, link_id, date)VALUES(?,?,?,?,?)");
					$insert_action->bind_param("sssss", $basic[0], $_COOKIE["user"], $action[1], $action[0], $action[2]);
					$insert_action->execute();
			//           }
			}
		 }

        //foreach ($user_view as $view){
         //   $insert_view = $db_connection->prepare("INSERT INTO serp.user_view (exp_id, user_id, view, date)VALUES(?,?,?,?);");
         //  $insert_view->bind_param("ssss", $basic[0], $_COOKIE["user"], $view[0], $view[1]);
         //   $insert_view->execute();
        //}

        setcookie("basic", '');
        //setcookie("mouse_movement", '');
    }else{
		if ($debug){
			echo $_COOKIE['basic'];
			echo "<br>";
			echo $_COOKIE['user_action'];
			echo "<br>";
			echo $_COOKIE['user_view'];
			echo "<br>";
			echo $_POST['feedback'];
			echo "<br>";
			setcookie("url", "");
			setcookie("query", "");
			setcookie("sequence", "");
			setcookie("topic0", "");
			setcookie("topic1", "");
			setcookie("basic", '');
			setcookie("mouse_movement", '');
		}

//        echo "
//        <script>
//            alert('Reading data error!');
//            window.location.href='index.html';
//        </script>";
    }
    setcookie("user_action", '');
    setcookie("user_view", '');

    $update_round_robin = $db_connection->prepare("UPDATE serp.round_robin SET done = 1 WHERE amazon_id = ? AND URL = ?");
    $update_round_robin ->bind_param("ss",$_COOKIE['user'], $_COOKIE['url']);
    $update_round_robin ->execute();

    setcookie("url", '');
    setcookie("query", '');
    setcookie("sequence", '');
    setcookie("topic0", "");
    setcookie("topic1", "");
/*

    $s ="SELECT * FROM serp.round_robin WHERE amazon_id = \"". $_COOKIE['user']."\"";
    $html_list = mysqli_query($db_connection,$s);
    while($row = mysqli_fetch_array($html_list)){
        $next_url = $row["URL"];
        $query = $row["query"];
        $sequence = $row["sequence"];
        $topic0 = $row["topic0"];
        $topic1 = $row["topic1"];
        $done = $row["done"];

        if($done == 0){
            setcookie("url", $next_url, $expire,'/');
            setcookie("query", $query, $expire,'/');
            setcookie("sequence", $sequence, $expire,'/');
            setcookie("topic0", $topic0, $expire,'/');
            setcookie("topic1", $topic1, $expire,'/');

            echo "
                <script>
                    alert('Thank you! Please proceed to next test!');
                    window.location.href='knowledge.php';
                </script>";
            break;
        }
    }
*/
   // if(!mysqli_fetch_array($html_list)){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str)-1;
        $random_str = '';
        for ($i=0;$i<16;$i++) {
            $num=mt_rand(0,$len);
            $random_str .= $str[$num];
        }
		#$update_finished = $db_connection->prepare("UPDATE serp.exp_verification_codes SET verification_code = ? WHERE amazon_id = ?;");
        #$update_finished ->bind_param("ss",$random_str, $_COOKIE['user']);
        #$update_finished ->execute();
		$insertq = $db_connection->prepare("INSERT INTO serp.exp_verification_codes (exp_id, amazon_id, verification_code)VALUES(?,?,?);");
		$insertq->bind_param("sss", $basic[0], $_COOKIE['user'],$random_str);
		$insertq->execute();
        //setcookie("user", "");


        setcookie("knowledge", "");
        setcookie("url", '');
        setcookie("query", '');
        setcookie("sequence", '');
        setcookie("topic0", "");
        setcookie("topic1", "");


        echo "
                <script>
                    window.location.href='end.php?code=$random_str';
                </script>";
   // }


} else {
    echo "
        <script>
            alert('Please login first!');
            window.location.href='index.html';
        </script>";
}
mysqli_close($db_connection);
?>


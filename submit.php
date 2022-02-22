<?php
include 'db_vars.php';
ini_set("display_errors", "stderr");

error_reporting(E_ALL);

$num_queries_per_user = 1;
$required_answers_per_query = 1;


#$SERVER = 'hcdm3.cs.virginia.edu';
#$USERNAME = 'zw3hk';
#$PORT = 3306;
#$PASSWORD = 'Fall2021!!';

$myfile = fopen("./dumps.txt", "w") or die("Unable to open file!");
#var_dump($GLOBALS);
#$data = ob_get_clean();
#fwrite($myfile, $data);

$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE, $PORT);

if (mysqli_connect_errno()) {
    echo "
        <script>
            alert('Failed to connect to MySQL db');
            window.location.href='index.html';
        </script>";
}

$shared_db_connection = new mysqli($USER_DATA_SERVER, $USER_DATA_USERNAME, $USER_DATA_PASSWORD, $USER_DATA_DB, $USER_DATA_PORT);

if (mysqli_connect_errno()) {
    echo "
        <script>
            alert('Failed to connect to MySQL shared db');
            window.location.href='index.html';
        </script>";
}
setcookie("url", '');
setcookie("query", '');
setcookie("sequence", '');

$round_robin = [];
$expire = time() + 60 * 60 * 24 ; //1day
if (mysqli_connect_errno()) {
    echo "
        <script>
            alert('Failed to connect to MySQL');
            window.location.href='index.html';
        </script>";
}

if (isset($_COOKIE['user'])) {
    $amazon_id = $_COOKIE['user'];
	if (isset($_POST['age'])){
		if (isset($_POST['education_field'])){
			$ef = $_POST['education_field'];
		}
		 else{
			$ef = "";
		}
		$insert_basic = $shared_db_connection->prepare("INSERT INTO serp_shared.user_data (user_id, age, gender, education_level, education_field) VALUES(?,?,?,?,?);");
		$insert_basic->bind_param("sssss", $_COOKIE["user"], $_POST["age"], $_POST["gender"], $_POST["education_level"],$ef);
		$insert_basic->execute();
		$insert_basic->free_result();
		$user_qs = '';
		$q = "SELECT URL,query,sequence,topic0, topic1 FROM serp.config_data WHERE sequence LIKE 'AY%' and answered < needed_answers ORDER BY used ASC limit 1;";
	}
	if (isset($_GET['q'])){

		$user_qs = $_GET['q'];
		$q = "SELECT URL,query,sequence,topic0, topic1 FROM serp.config_data WHERE sequence LIKE 'AY%' and answered < needed_answers and query not in ".$user_qs." ORDER BY used ASC limit 1;";
	}

//        $find_entry = mysqli_query($db_connection,"select entry_file from serp.config_query_data;");
//
//        while($entry = mysqli_fetch_row($find_entry)) {
//            $q = "SELECT URL,query,sequence,topic0, topic1 FROM serp.config_data WHERE entry_file =\"".$entry[0]."\" AND answered < 3 ORDER BY used ASC limit 1;";
//            $q = "SELECT URL,query,sequence,topic0, topic1 FROM serp.config_data WHERE entry_file =\"".$entry[0]."\" ORDER BY answered ASC limit 1;";
//select all:
//            $q = "SELECT URL,query,sequence,topic0, topic1 FROM serp.config_data WHERE answered < 1 ORDER BY used ASC limit 1;";
//selected maybe ads:
	$html_list = mysqli_query($db_connection, $q);

#		while($row = mysqli_fetch_row($html_list)){
	$row = mysqli_fetch_row($html_list);

	if (!isset($row)){
		    echo "
        <script>
            alert('An internal error has occured. We applogize for the inconvenience.');
            window.location.href='index.html';
        </script>";
	}
	else{
		$url = $row[0];
		$query = $row[1];
		$sequence = $row[2];
		$topic0 = $row[3];
		$topic1 = $row[4];

		setcookie("url", $url, $expire,'/');
		setcookie("query", $query, $expire,'/');
		setcookie("sequence", $sequence, $expire,'/');
		setcookie("topic0", $topic0, $expire,'/');
		setcookie("topic1", $topic1, $expire,'/');

		$update_used = $db_connection->prepare("UPDATE serp.config_data SET used = used + 1 WHERE URL = ?");
		$update_used->bind_param("s", $url);
		$update_used->execute();

		$insert = $db_connection->prepare("insert into serp.round_robin (amazon_id, URL, query ,sequence, topic0, topic1) values (?, ?, ?, ?, ?, ?);");
		$insert->bind_param("ssssss", $amazon_id,$url, $query, $sequence, $topic0, $topic1);
		$insert->execute();
	#		}

		if (empty($user_qs)){
			$user_qs =  "('".$query."')";
		}
			else{
				$user_qs =  substr($user_qs,0, -1);
				$user_qs = $user_qs.",'".$query."')";
			}



		$update_queries = $shared_db_connection->prepare("UPDATE serp_shared.user_data SET queries = ?  WHERE user_id = ?");
		$update_queries->bind_param("ss", $user_qs, $amazon_id);
		$update_queries->execute();

		$u_history =  $db_connection->prepare("SELECT count(*) FROM serp.exp_data where user_id=?");
		$u_history->bind_param("s",$amazon_id);
		$u_history->execute();
		$u_history->bind_result($num_exps);
		$result = $u_history->fetch();
		$u_history->free_result();
		$exp_id = $amazon_id.($num_exps+1);
		setcookie("exp_id", $exp_id, $expire);

	//        }

		//setcookie("user", $amazon_id, $expire);
		#header("Location: start.php");
		header("Location: knowledge.php");
		/* echo "
				<script>
					alert('Thank you for participating, you test will start now! ');
					window.location.href='knowledge.php';
				</script>";*/
		#header("Location: index.html");

}


}else{
    echo "
        <script>
            alert('Error on read user!');
            window.location.href='index.html';
        </script>";
}
mysqli_close($db_connection);
mysqli_close($shared_db_connection);
?>
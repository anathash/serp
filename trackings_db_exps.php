<?php
ini_set("display_errors", "stderr");

error_reporting(E_ALL);
$SERVER = 'localhost:8000';
$USERNAME = 'root';

$PORT = 3306;
#$PASSWORD = 'Fall2021!!';
$PASSWORD = 'anat';
$DATABASE = 'serp';
$myfile = fopen("./pings.txt", "a") or die("Unable to open file!");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
if ($db_connection->connect_error) {
  fwrite($myfile,"Connection failed: " . $db_connection->connect_error);
} else{
  fwrite($myfile,"Connection success \n: ");
}
$expire = time() + 60 * 60 * 24 ; //1day


#var_dump($GLOBALS);
#$data = ob_get_clean();

#fwrite($myfile, "ping\n");
if (isset($_COOKIE['basic'])){
	$basic = json_decode($_COOKIE['basic']);
	$pos = $_GET['pos'];
	$t = date("m/d/Y, h:i:s A");  
	$action = 'click link';
	fwrite($myfile, $basic[0].",".$_COOKIE["user"].","."click link".$pos.",".$t);	
	$insert_action = $db_connection->prepare("INSERT INTO serp.user_action (exp_id, user_id, action, link_id, date) VALUES(?,?,?,?,?);");
	$insert_action->bind_param("sssss", $basic[0], $_COOKIE["user"], $action, $pos, $t);
	$insert_action->execute();
	$insert_action->close();
#	if ( false===$insert_action ) {
#		fwrite($myfile,'prepare() failed: ' . $mysqli->error);
#	}
#    $insert_action->bind_param("sssss", $basic[0], $_COOKIE["user"], 'click link', $pos, $t);
#    $result =$insert_action->bind_param("sssss", 'c87ZeWnQ', 'u11', 'click link', '11','12/2/2021, 8:27:58 PM');
#	if ( false===$result ) {
#		fwrite($myfile,'bind_param() failed' . $mysqli->error);
#	}
    #$insert_action->execute();
	#if ( false===$insert_action ) {
	#	fwrite($myfile,'execute() failed: ' . $insert_action->error);
	#}
	#fwrite($myfile,$result);
	#fwrite($myfile,$insert_action->fullQuery);
	
#	$sql = "INSERT INTO serp.user_action (exp_id, user_id, action, link_id, date) VALUES ('c87ZeWnQ', 'u1', 'click link', '11','12/2/2021, 8:27:58 PM' )";
#	if (mysqli_query($db_connection, $sql)) {
#		fwrite($myfile,"New record created successfully");
#	} else {
#		fwrite($myfile,"Error: " . $sql . "<br>" . mysqli_error($db_connection));
#	}
}
#fwrite($myfile, $data);
fclose($myfile);
mysqli_close($db_connection);
?>

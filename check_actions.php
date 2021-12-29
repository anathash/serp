<?php
include 'db_vars.php';
ini_set("display_errors", "stderr");
date_default_timezone_set('UTC');
error_reporting(E_ALL);

$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
$sql="select count(*) as count from serp_test_test.user_action where action = 'click link' and user_id = \"". $_GET['user']."\"";
$result=mysqli_query($db_connection,$sql);
$data=mysqli_fetch_assoc($result);
echo $data['count'];
$db_connection->close();
?>
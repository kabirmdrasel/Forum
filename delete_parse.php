<?php
session_start();
if($_SESSION['uid']){
	if (isset($_POST['topic_submit'])) {
		include_once("connect.php");
		
		$tcr = $_POST['tcr'];
		$id = $_POST['id'];
		
		
		$sql2 = "delete from posts where id='".$id."'";
		$res2 = mysql_query($sql2) or die(mysql_error());
		
}
}

?>

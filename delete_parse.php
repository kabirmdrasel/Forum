<?php
session_start();
if($_SESSION['uid']){
	if (isset($_POST['topic_submit'])) {
		$db= mysqli_connect('localhost','root','','forum');
		
		$tcr = $_POST['tcr'];
		$id = $_POST['id'];
		
		
		$sql2 = "delete from posts where id='".$id."'";
		$res2 = mysqli_query($db,$sql2);
		
}
}

?>

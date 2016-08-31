<?php
session_start();
if($_SESSION['uid']){
	if (isset($_POST['topic_submit'])) {
		$db = mysqli_connect('localhost','root','','forum');
		
		$tcr = $_POST['tcr'];
		$id = $_POST['id'];
		$update_content = $_POST['update_content'];
		
		$sql2 = "update posts set post_date=now(),post_content='".$update_content."' where post_creator='".$tcr."' and id='".$id."' limit 1";
		$res2 = mysqli_query($db,$sql2);
		
}
}

?>

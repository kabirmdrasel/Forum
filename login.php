<?php
 session_start();
 mysql_connect('localhost','root','') or die(mysql_error());
 mysql_select_db('forum');

 if (isset($_POST['username'])) {
 	$username=$_POST['username'];
 	$password=$_POST['password'];
 	$sql= "select * from users where username='".$username."' and password='".$password."'LIMIT 1";
 	$res=mysql_query($sql) or die(mysql_error());

 	if (mysql_num_rows($res)==1) {
 		$row =mysql_fetch_assoc($res);
 		
 		$_SESSION['uid']=$row['id'];
 		$_SESSION['username']=$row['username'];
 		header("Location:index.php");
 		exit();

 	}else{
 		echo "Invalid login information. Please return to the previous page";
 		exit();
 	}
 }

?>
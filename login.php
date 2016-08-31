<?php
 session_start();
 $db=mysqli_connect('localhost','root','','forum');

 if (isset($_POST['username'])) {
 	$username=$_POST['username'];
 	$password=$_POST['password'];
 	$sql= "select * from users where username='".$username."' and password='".$password."'LIMIT 1";
 	$res=mysqli_query($db,$sql);

 	if (mysqli_num_rows($res)==1) {
 		$row =mysqli_fetch_assoc($res);
 		
 		$_SESSION['uid']=$row['id'];
 		$_SESSION['username']=$row['username'];
 		header("Location:index.php");
// 		exit();

 	}else{
 		echo "Invalid login information. Please return to the previous page";
 		exit();
 	}
 }

?>
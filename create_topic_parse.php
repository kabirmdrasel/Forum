<?php  session_start();?>

       <?php
       if($_SESSION['uid'] == ""){
          header("Location: index.php");
          exit();
          }
         if (isset($_POST['topic_submit'])) {
         	if (($_POST['topic_title']=="")&&($_POST['topic_content']=="")) {
         		echo "You did not fill in both fields.Please return to the previous page.";
         		exit();
         	}else{
         		$db=mysqli_connect('localhost','root','','forum');

            
          	    $cid=$_POST['cid'];
         		$title=$_POST['topic_title'];
         		$content=$_POST['topic_content'];
         		$creator=$_SESSION['uid'];
         		$sql= "insert into topics(category_id,topic_title,topic_creator,topic_date,topic_reply_date,topics_content) values ('".$cid."','".$title."','".$creator."',now(),now(),'".$content."')";
         		$res=mysqli_query($db,$sql);
         		$new_topic_id=mysqli_insert_id();
         		// $sql2="insert into posts(category_id,topic_id,post_creator,post_date) values ('".$cid."','".$new_topic_id."','".$creator."',now())";

         		// $res2=mysqli_query($sql2) or die(mysqlii_error());
         		$sql3="update categories set last_post_date=now(),last_user_poster='".$creator."' where id='".$cid."' limit 1";
         		$res3=mysqli_query($db,$sql3);
         		if (($res)&&($res3)) {
         			header("Location:view_topic.php?cid=".$cid." &tid=".$new_topic_id."");

         		}else{
         			echo "There was a problem creating your topic. Please try again.";
         		}
         	}
         }
       ?>
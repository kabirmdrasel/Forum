<?php
session_start();
if($_SESSION['uid']){
	if (isset($_POST['replySubmit'])) {
		include_once("connect.php");
		$creator =  $_SESSION['uid'];
		$cid = $_POST['cid'];
		$tid = $_POST['tid'];
		$reply_content = $_POST['reply_content'];
		$sql = "insert into posts (category_id, topic_id, post_creator, post_content,post_date) values ('".$cid."','".$tid."','".$creator."','".$reply_content."',now())";
		$res = mysql_query($sql) or die(mysql_error());
		$sql2 = "update categories set last_post_date=now(),last_user_poster='".$creator."' where id='".$cid."' limit 1";
		$res2 = mysql_query($sql2) or die(mysql_error());
		$sql3 = "update topics set topic_reply_date=now(), topic_last_user='".$creator."' where id='".$tid."' limit 1";
		$res3 = mysql_query($sql3) or die(mysql_error());

		//mailing
		$userids[]="";
		$email="";
        $sql4 = "select post_creator from posts where category_id='".$cid."' and topic_id='".$tid."' group by post_creator";
        $res4 = mysql_query($sql4) or die(mysql_error());
        while ($row4 = mysql_fetch_assoc($res4)) {
        	$userids[] .= $row4['post_creator'];
        }foreach ($userids as $key) {
        	$sql5 = "select id, email from users where id='".$key."' and forum_notification='1' limit 1";
        	$res5 = mysql_query($sql5) or die(mysql_error());
        	if (mysql_num_rows($res5)>0) {
        		$row5 = mysql_fetch_assoc($res5);
        		if ($row5['id'] != $creator) {
        			$email .= $row5['email'].",";
        		}
        	}
        }
        $email = substr($email, 0,(strlen($email)-2));
        $to = "noreply@somewhere.com";
        $from = "kabirmdrasel@gmail.com";
        $bcc = $email;
        $subject = "Forum Reply";

        $message = "Someone has replied to a topic you were apart of.";
        $headers = "From: $from\r\nReply-To: $from";
        $headers .= "\r\nBcc: {$bcc}";
        mail($to, $subject,$message,$headers);
		if ( ($res) && ($res2) && ($res3)) {

			echo "<p> Your reply has been successfully posted. <a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Clickere to return to the topic.</a></p>";
		}else{
			echo "<p>There was a problem posting your reply. Try again please.</p>";

		}
	}else{
		exit();
	}
}else{
	exit();
}

?>

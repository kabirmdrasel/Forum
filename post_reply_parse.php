<?php
session_start();
if($_SESSION['uid']){
	if (isset($_POST['replySubmit'])) {
		$db=mysqli_connect('localhost','root','','forum');
		$creator =  $_SESSION['uid'];
		$cid = $_POST['cid'];
		$tid = $_POST['tid'];
		$reply_content = $_POST['reply_content'];
		$sql = "insert into posts (category_id, topic_id, post_creator, post_content,post_date) values ('".$cid."','".$tid."','".$creator."','".$reply_content."',now())";
		$res = mysqli_query($db,$sql);
		$sql2 = "update categories set last_post_date=now(),last_user_poster='".$creator."' where id='".$cid."' limit 1";
		$res2 = mysqli_query($db,$sql2);
		$sql3 = "update topics set topic_reply_date=now(), topic_last_user='".$creator."' where id='".$tid."' limit 1";
		$res3 = mysqli_query($db,$sql3);

		//mailing
		$userids[]="";
		$email="";
        $sql4 = "select post_creator from posts where category_id='".$cid."' and topic_id='".$tid."' group by post_creator";
        $res4 = mysqli_query($db,$sql4);
        while ($row4 = mysqli_fetch_assoc($res4)) {
        	$userids[] .= $row4['post_creator'];
        }foreach ($userids as $key) {
        	$sql5 = "select id, email from users where id='".$key."' and forum_notification='1' limit 1";
        	$res5 = mysqli_query($db,$sql5);
        	if (mysqli_num_rows($res5)>0) {
        		$row5 = mysqli_fetch_assoc($res5);
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

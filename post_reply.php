<?php  session_start();?>

       <?php
       if((!isset($_SESSION['uid'])) || ($_GET['cid'] == "")){
          header("Location: index.php");
          exit();
          }
         $cid=$_GET['cid'];
         $tid=$_GET['tid'];
       ?>

<!DOCTYPE html>

    <html>
       <head>
           <title>Post forum reply</title>
           <link rel="stylesheet" type="text/css" href="style.css">
       </head>

       <body>
            <div id="wrapper">
                <h2>Forum Login Page</h2>
            
       <?php 
       echo "You are logged in as ".$_SESSION['username']." <a href='logout.php'>Logout </a>";
       ?>


       <hr />
       <div id="content">
        <form action="post_reply_parse.php" method="post">
          <P>Reply Content</P>
          <textarea name="reply_content" rows="5" cols"75"> </textarea>
          <br /><br />
          <input type="hidden" name="cid" value="<?php echo $cid; ?>"/>
          <input type="hidden" name="tid" value="<?php echo $tid; ?>"/>
          <input type="submit" name="replySubmit" value="Post Your Reply"/>
        </form>
       </div>
       </div>


       </body>
</html>
<?php  session_start();?>

       <?php
       if((!isset($_SESSION['uid'])) || ($_GET['cid'] == "")){
          header("Location: index.php");
          exit();
          }
         $cid=$_GET['cid'];
       ?>

<!DOCTYPE html>

    <html>
       <head>
           <title>Create Forum Topic</title>
           <link rel="stylesheet" type="text/css" href="style.css">
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
           <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       </head>

       <body>
            <div id="wrapper">
                <h2>Forum Login Page</h2>
            
       <?php 
       echo "You are logged in as ".$_SESSION['username']." <a href='logout.php'>Logout </a>";
       ?>


       <hr />
       <div id="content">
        <form action="create_topic_parse.php" method="post">
          <p>Post Title</p>
          <input type="text" name="topic_title" size="98" maxlength="150"/>
          <p>Post Content</p>
          <textarea name="topic_content" rows="5" cols="75"></textarea>
          <br /><br />
          <input type="hidden" name="cid" value="<?php echo $cid; ?>"/>
          <input type="submit" name="topic_submit" value="Create Your Post"/>
        </form>
       </div>
       </div>


       </body>
</html>
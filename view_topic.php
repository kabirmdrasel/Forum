

<?php

session_start();

?>
<!DOCTYPE html>

    <html>
       <head>
           <title>Forum Login</title>
           <link rel="stylesheet" type="text/css" href="style.css">
             <meta charset="utf-8">
             <meta name="viewport" content="width=device-width, initial-scale=1">
             <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
             <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       </head>

       <body>
        <div class="container">
            <div id="wrapper">
                <h2>Forum Login Page</h2>
            

       <?php
       if(!isset($_SESSION['uid'])){
           echo"<form action='login.php' method='post'>
            Username: <input type='text' name='username'/> &nbsp;
            Password: <input type='text' name='password'/> &nbsp;
            <input type='submit' value='Log in' name='submit'/>";
          }
          else{
              echo "You are logged in as ".$_SESSION['username']." <a href='logout.php'>Logout </a>";
                        

          }
       ?>

       <hr />
       <div id="content">
           <?php
           mysql_connect('localhost','root','') or die(mysql_error());
           mysql_select_db('forum');


           $cid = $_GET['cid'];
           $tid="";
           if (isset($_GET['tid'])) {
             $tid=$_GET['tid'];
           }

           // $tid=$_GET['tid'];
           

           
           $sql = "select * from topics where category_id='".$cid."' and id='".$tid."' Limit 1";
           $res = mysql_query($sql) or die(mysql_error());
           

           if (mysql_num_rows($res)==1) {
             echo "<table width='100%'>";
             if ($_SESSION['uid']) {
               echo "<tr><td colspan='2'><input type='submit' value='Add Reply' OnClick=\"window.location= 'post_reply.php?cid=".$cid."&tid=".$tid."'\" /><hr />";
             }else{
              echo"<tr><td colspan='2'><p>Please log in to add your reply.</p><hr /></td></tr>";
             }
             while ($row=mysql_fetch_assoc($res)) {
              
              ?>
                <div class="panel-group">
                <div class="panel panel-primary">
                <div class="panel-heading"><?php echo $row['topic_title'] ?></div>
                <div class="panel-body"><?php echo 'posted by:'. $row['topic_creator'] .'-'. $row['topic_date'] ?></div>
                </div>

             <?php
 // var_dump($cid);
               $sql2="select * from posts where category_id='".$cid."' and topic_id='".$tid."'";
               $res2=mysql_query($sql2) or die(mysql_error());

               while ($row2=mysql_fetch_assoc($res2)) {
                $tcr=$row2['post_creator'];
                $id=$row2['id'];
                ?>
                <div class="panel-group">
                <div class="panel panel-success">
                <div class="panel-heading"><?php echo'commented by:' .$row2['post_creator'].'-'.$row2['post_date'] ?></div>
                <div class="panel-body"><?php echo 'Comment:'. $row2['post_content'] ?>
                  <?php 
                  if (($_SESSION['uid']) == $tcr) {
                    
                  echo "<span><input type='submit' value='Update' OnClick=\"window.location= 'update.php?cid=".$cid."&tcr=".$tcr."&id=".$id."'\" /></span>";
            
                  echo "<span><input type='submit' value='Delete' OnClick=\"window.location= 'delete.php?cid=".$cid."&tcr=".$tcr."&id=".$id."'\" /></span>";
                  }
                  ?>
                </div>
                <?php 

               }
               $old_views=$row['topic_views'];
               $new_views=$old_views+1;
               $sql3="update topics set topic_views='".$new_views."'where category_id='".$cid."' and id='".$tid."' LIMIT 1";
               $res3=mysql_query($sql3) or die(mysql_error());



             }
           }else{
            echo "<p>This topic does not exist.</p>";
           }
           ?> 
       </div>
       </div>
     </div>


       </body>
</html>
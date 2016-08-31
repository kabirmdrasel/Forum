<?php  session_start();?>

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
        <?php
           $db = mysqli_connect('localhost','root','','forum');

            $tcr="";
            $id="";
            if (isset($_GET['tcr'])) {
             $id=$_GET['id'];
           }
            $cid=$_GET['cid'];
            if (isset($_GET['tcr'])) {
             $tcr=$_GET['tcr'];
           }
           

           $sql= "select * from posts where post_creator='".$tcr."' and id='".$id."' limit 1";
            $res=mysqli_query($db,$sql);

            while ($row=mysqli_fetch_assoc($res)){
               // var_dump($row);
              $t=$row['post_creator'];
              $pc=$row['post_content'];
              // var_dump($t);
              // var_dump($_SESSION['uid']);
               if (($_SESSION['uid']) == $tcr) {
             ?> 
            <form action="update_parse.php" method="post">
            <p class="btn btn-success">Update your comment</p><br>
            <textarea name="update_content" rows="5" cols="25"><?php echo $pc ?></textarea>
            <br /><br />
            <input type="hidden" name="tcr" value="<?php echo $tcr; ?>"/>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="submit" name="topic_submit" class="btn btn-warning" value="Update Your Comment" onclick="return confirm('Are you sure want to update?')"/>
          </form>
          <?php
            }
            else{
              echo "Please log in first";
            }
            }
           

        ?>
<!--           <ul class="pager">-->
<!--               <li><a href="view_topic.php">Previous</a></li>-->
<!--               <li><a href="#">Next</a></li>-->
<!--           </ul>-->

       </div>
       </div>


       </body>
</html>
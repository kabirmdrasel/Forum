
<!--this is the starting page-->
<?php  session_start();?>
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
            <div id="wrapper">
                <h2>Forum Login </h2>
            

       <?php
       if(!isset($_SESSION['uid'])){
           echo"<form action='login.php' method='post'>
            Username: <input type='text' name='username'/> &nbsp;
            Password: <input type='password' name='password'/> &nbsp;
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
          $sql= "select * from categories order by category_title asc";
          $res=mysql_query($sql) or die(mysql_errno());
          $categories="";
          if (mysql_num_rows($res)>0) {
            while ($row=mysql_fetch_assoc($res)) {
              $id=$row['id'];
              $title=$row['category_title'];
              $description=$row['category_description'];
              $categories .=" <a href='topic_parse.php?cid=".$id."&title=".$title."' id='cat_link'>".$title." - <font size='1'> ".$description."</font> </a>";
            }
            echo $categories;
          }else{
            echo "There are no categories available yet.";
          }
          ?>



       </div>
       </div>


       </body>
</html>
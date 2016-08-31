

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
            <div id="wrapper">
                <h2>Forum Login Page</h2>
            

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
          $db=mysqli_connect('localhost','root','','forum');
          $cid = $_GET['cid'];
          $topics=null ;
          if (isset($_SESSION['uid'])) {
            $logged=" | <a href='create_topic.php?cid=".$cid."'>Click Here to Create a Post</a>";
          }else{
            $logged=" | Please log to create topic in this form.";
          }

          $sql="select id from topic where id='".$cid."'";
          $res =mysqli_query($db,$sql);
          if (mysqli_num_rows($res)==1) {
            $sql2="select * from topics where category_id='".$cid."' order by topic_reply_date DESC";
            $res2=mysqli_query($db,$sql2);
            if (mysqli_num_rows($res2) > 0) {
              
              $topics .= "<table width ='100%' style='border-collapse: collapse;'>";
              $topics .= "<tr><td colspan='3'><a href='index.php'>Return to Forum Index</a>".$logged."<hr /></td></tr>";
              $topics .= "<tr style='background-color: #dddddd;'><td>Your Posts</td><td width='65' align='center'>Replies</td><td width='65' align='center'>Views</td></tr>";
              $topics .="<tr><td colspan='3'><hr/></td><tr>";

              while ($row=mysqli_fetch_assoc($res2)) {
                $tid=$row['id'];
                $title=$row['topic_title'];
                $views=$row['topic_views'];
                $date= $row['topic_date'];
                $creator=$row['topic_creator'];
                $topics.="<tr><td><a href='view_topic.php?cid=".$cid."&tid=".$tid."'>".$title."</a><br/><span class='post_info'>Posted By: ".$creator." on ".$date."</span></td><td align='center'>0</td><td align='center'>".$views."</td></tr>";
                $topics .= "<tr><td colspan='3'><hr/></td></tr>";
              }
              $topics .="</table>";
              echo $topics;
            }else{
              echo "<a href='index.php'>Return To Forum Index</a><hr />.";
               echo "<p>There is no topics in this category  yet.".$logged."</p>";
            }

          }else{
            echo "<a href='index.php'>Return To Forum Index</a><hr />.";
            echo "You are trying to view a category that does not exist.";
          }
          ?>
       </div>
       </div>


       </body>
</html>
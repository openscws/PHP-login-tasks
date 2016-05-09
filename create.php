<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   <body>
   
   <?php 
   echo "<h1>Welcome  $login_session </h1>";
    $sql = "SELECT * FROM admin";
    $result = mysqli_query($db,$sql);
	$users = array();
while($row = mysqli_fetch_assoc($result)){
  $users[] = $row;
 
}
   

 $result->free();
 
 
 
 
 if($_SERVER["REQUEST_METHOD"] == "POST") {
	 $user = mysqli_real_escape_string($db,$_POST['user']);
      $task = mysqli_real_escape_string($db,$_POST['task']);
	 
	  $sql = "INSERT INTO task (adminid,task,isCompleted) VALUES ('$user','$task',0);";
       mysqli_query($db,$sql);
	 
 }
 $user=$_SESSION['login_user'];
   $sql = "SELECT * FROM admin WHERE username='$user'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($row['isAdmin']==1){
			echo "
			<form action = \"\" method = \"post\">
                  <label>Task  :</label><input type = \"text\" name = \"task\" class = \"box\"/><br /><br />
                  
				  <select id=\"user\" name=\"user\">";
					
					
					foreach($users as $k=>$val){
						echo "<option value=\"".($k+1)."\">".$users[$k]['username']."</option>";
					}
					
					
					
			echo	"  </select>
                  <input type = \"submit\" value = \" Submit \"/><br />
               </form>
      
			";
		}
		else echo "You're not allowed here";
   ?>
   
    
	   <p><a href = "welcome.php">Home</a></p>
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>
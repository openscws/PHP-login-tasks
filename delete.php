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
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	 
      $taskid = mysqli_real_escape_string($db,$_POST['task']);
	 
	  $sql = "DELETE FROM task WHERE id='$taskid';";
       mysqli_query($db,$sql);
	 
 }
   
   
   
   
   //check user and proceed with the program
$user=$_SESSION['login_user'];
   $sql = "SELECT * FROM admin WHERE username='$user'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($row['isAdmin']==1){
		
$sql = "SELECT * FROM task";
$result = mysqli_query($db,$sql);

$tasks = array();
while($row = mysqli_fetch_assoc($result)){
  $tasks[] = $row;
}
 $result->free();
 
 
 //get users
    $sql = "SELECT * FROM admin";
    $result = mysqli_query($db,$sql);
	$users = array();
while($row = mysqli_fetch_assoc($result)){
  $users[] = $row;
}
		
echo "
			<form action = \"\" method = \"post\">
                 
                  
				  <select id=\"task\" name=\"task\">";
					
					
					foreach($tasks as $k=>$val){
						echo "<option value=\"".$tasks[$k]['id']."\">".$tasks[$k]['task'];
						if($tasks[$k]['isCompleted']==0)echo " [unfinished] ";
						else {echo " [finished] ";}
						foreach($users as $g=>$val2){
						if($tasks[$k]['adminid']==$users[$g]['id']){
							echo " [".$users[$g]['username']."]";
						}
						}
						echo "</option>";
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
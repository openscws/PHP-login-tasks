<?php
   session_start();
   mysqli_close($db);
   if(session_destroy()) {
      header("Location: login.php");
   }
?>
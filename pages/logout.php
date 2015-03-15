<?php
  session_start();
   session_destroy();
   header("location:../index.php"); //redirect to entry page on logout
?>
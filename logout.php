<?php
  session_start();
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  session_destroy();
  echo "<script>window.location.replace('index.php');</script>"
 ?>

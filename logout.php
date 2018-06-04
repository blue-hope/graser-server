<?php
  session_start();

  unset($_SESSION['user_id']);
  unset($_SESSION['user_name']);
  unset($_SESSION['user_type']);
  unset($_SESSION['resv']);
  unset($_SESSION['user_N']);
  unset($_SESSION['txt']);

  session_destroy();
  echo "<script>window.location.replace('index.php');</script>"
 ?>

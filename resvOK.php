<?php
  session_start();
  $date_s = $_POST['date'];
  $ppl = $_POST['inputppl'];
  $txt = $_POST['inputtxt'];
  $date = explode(", ", $date_s);
  $month = $date[1];
  $day = $date[2];
  $year = $date[3];
  $storeN = $_GET['i'];

  $conn = mysqli_connect("localhost","root","kwondong704","users");

  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }

  $sql = "INSERT INTO resvs VALUES ('0','".$year."', '".$month."', '".$day."', '".$txt."', '".$_SESSION['user_N']."', false, '".(int)$ppl."', '".$storeN."')";
  $sql2 = "UPDATE users SET resv = resv+1 where user_N = '".$_SESSION['user_N']."'";

  $result = mysqli_query($conn, $sql);
  $result2 = mysqli_query($conn, $sql2);
  if($result){
    mysqli_close($conn);
    echo "<script>alert('날짜등록에 성공하였습니다!');</script>";
    $_SESSION['resv'] = $_SESSION['resv']+1;
    echo "<script>window.location.replace('find.php');</script>";
  }
  else{
    mysqli_close($conn);
    echo "<script>alert('날짜등록에 실패하였습니다!');</script>";
    echo "<script>window.location.replace('find.php');</script>";
  }

 ?>

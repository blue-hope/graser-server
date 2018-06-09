<?php
  session_start();
  $m = $_GET['m'];
  $d = $_GET['d'];
  $y = $_GET['y'];
  $expl = $_GET['txt'];
  $ppl = $_GET['ppl'];
  $conn = mysqli_connect("localhost","root","kwondong704","users");

  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }
  $sql2 = "SELECT * FROM stores where user_N = '".$_SESSION['user_N']."'";
  $result2 = mysqli_query($conn, $sql2);
  $res2 = mysqli_fetch_assoc($result2);
  $storeN = $res2['store_N'];

  $sql = "INSERT INTO resvs VALUES ('0','".$y."', '".$m."', '".$d."', '".$expl."', '".$_SESSION['user_N']."', true, '".(int)$ppl."', '".$storeN."')";
  $result = mysqli_query($conn, $sql);
  if($result){
    mysqli_close($conn);
    echo "<script>alert('날짜등록에 성공하였습니다!');</script>";
    echo "<script>window.location.replace('mypage.php');</script>";
  }
  else{
    echo "<script>alert('날짜등록에 실패하였습니다!');</script>";
    echo mysqli_error($conn);
    mysqli_close($conn);
  }


 ?>

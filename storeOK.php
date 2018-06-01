<?php
  session_start();
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $store = $_POST['store'];
  $ppl = (int)$_POST['ppl'];
  $txt = $_POST['txt'];
  $tag = $_POST['tag'];
  $user_N = $_SESSION['user_N'];

  $conn = mysqli_connect("localhost", "root", "kwondong704","users");


  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }

  $sql = "INSERT INTO stores VALUES ('0','".$user_N."', '".$lat."', '".$lng."', '".$store."', '".$ppl."', '".$txt."', '".$tag."')";
  $result = mysqli_query($conn, $sql);

  if($result){
    echo "<script>alert('지점 등록에 성공하였습니다!');</script>";

    $sql2 = "UPDATE users SET resv = 1 WHERE user_N = '".$user_N."'";
    $result2 = mysqli_query($conn, $sql2);

    mysqli_close($conn);
    $_SESSION['resv'] = 1;
    echo "<script>window.location.replace('mypage.php');</script>";
  }
  else{
    echo "<script>alert('지점 등록에 실패하였습니다!');</script>";
    //echo "<script>window.location.replace('mypage.php');</script>";
    mysqli_close($conn);
  }
 ?>

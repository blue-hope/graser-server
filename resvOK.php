<?php
  session_start();
  $date_s = $_POST['date'];
  $ppl = $_POST['inputppl'];
  $txt = $_POST['inputtxt'];
  $date = explode(", ", $date_s);
  $month = $date[1];
  $day = $date[2];
  $year = $date[3];

  $conn = mysqli_connect("localhost","root","kwondong704","users");

  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }

  $sql = "INSERT INTO resvs VALUES ('0','".$year."', '".$month."', '".$day."', '".$txt."', '".$_SESSION['user_N']."', false, '".(int)$ppl."')";
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

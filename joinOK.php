<?php
  $user_id = $_POST['user_id'];
  $user_pw = $_POST['user_pw'];
  $user_name = $_POST['user_name'];
  $user_nick = $_POST['user_nick'];
  $user_email = $_POST['user_email'];
  $user_type = $_POST['user_type'];

  if ( !isset($_POST['user_id']) || !isset($_POST['user_pw']) || !isset($_POST['user_name']) || !isset($_POST['user_nick']) || !isset($_POST['user_email'])) {
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');";
    echo "window.location.replace('login.html');</script>";
    exit;
  }

  if (!isset($_POST['user_type'])){
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');";
    echo "window.location.replace('login.html');</script>";
    exit;
  }

  $conn = mysqli_connect("localhost","root","kwondong704","users");

  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }

  $sql = "INSERT INTO users VALUES ('0','".$user_id."', '".$user_pw."', '".$user_name."', '".$user_nick."', '".$user_email."', '".$user_type."', '0')";
  $result = mysqli_query($conn, $sql);
  if($result){
    mysqli_close($conn);
    echo "<script>alert('회원가입에 성공하였습니다!');</script>";
    echo "<script>window.location.replace('login.html');</script>";
  }
  else{
    echo "<script>alert('회원가입에 실패하였습니다!');</script>";
    echo mysqli_error($conn);
    mysqli_close($conn);
  }

 ?>

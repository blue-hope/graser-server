<?php
    if ( !isset($_POST['user_id']) || !isset($_POST['user_pw']) ) {
        header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');";
        echo "window.location.replace('login.html');</script>";
        exit;
    }
    $user_id = $_POST['user_id'];
    $user_pw = $_POST['user_pw'];
    $conn = mysqli_connect("localhost", "root", "kwondong704","users");


    if(!$conn){
      print "Error - Could not connect to MySQL: ".mysqli_error();
      exit;
    }

    $sql = "SELECT * FROM users WHERE user_ID = '".$user_id."' AND user_PW = '".$user_pw."'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    if(isset($res['user_ID'])){
      echo "<script>alert('로그인에 성공하였습니다!');</script>";
      /* If success */
      session_start();
      $_SESSION['user_id'] = $res['user_ID'];
      $_SESSION['user_name'] = $res['user_Name'];
      $_SESSION['user_type'] = $res['user_Type'];
      $_SESSION['resv'] = $res['resv'];
      $_SESSION['user_N'] = $res['user_N'];


      $sql2 = "SELECT * FROM stores WHERE user_N = '".$_SESSION['user_N']."'";
      $result2 = mysqli_query($conn, $sql);
      $res2 = mysqli_fetch_assoc($result);

      $_SESSION['txt'] = $res2['txt'];

      mysqli_close($conn);
      echo "<script>window.location.replace('index.php');</script>";
    }
    else{
      echo "<script>alert('로그인에 실패하였습니다!');</script>";
      echo "<script>window.location.replace('login.html');</script>";
      mysqli_close($conn);
    }


?>

<?php
    if ( !isset($_POST['user_id']) || !isset($_POST['user_pw']) ) {
        header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');";
        echo "window.location.replace('login.php');</script>";
        exit;
    }
    $user_id = $_POST['user_id'];
    $user_pw = $_POST['user_pw'];
<<<<<<< HEAD
    $conn = mysql_connect("localhost", "root", "kwondong704");


    if(!$conn){
      print "Error - Could not connect to MySQL";
      exit;
    }

    $user = mysql_select_db("user");
    
    $members = array(
        'ms7045436' => array('password' => 'kwondong704', 'name' => '권동현'),
    );

=======
    $members = array(
        'ms7045436' => array('password' => 'kwondong704', 'name' => '권동현'),
    );
>>>>>>> 7c8a7300813e37f7aad5c41e002db6759d3f6e25
    if( !isset($members[$user_id]) || $members[$user_id]['password'] != $user_pw ) {
        header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');";
        echo "window.location.replace('login.php');</script>";
        exit;
    }
    /* If success */
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $members[$user_id]['name'];
<<<<<<< HEAD
    echo "<script>window.location.replace('index.php');</script>"
=======
>>>>>>> 7c8a7300813e37f7aad5c41e002db6759d3f6e25
?>

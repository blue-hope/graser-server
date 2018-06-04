<?php
	session_start();
	$tmpid = explode("@", $_POST['email']);
	$conn = mysqli_connect("localhost","root","kwondong704","users");

  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
	}

	$sql = "SELECT * FROM users WHERE user_PW = 'google'";
  $isid = 'f';
  $result = mysqli_query($conn, $sql);
  if($result){
    while($row = mysqli_fetch_assoc($result)){
      if($row['user_ID'] == explode("@", $_POST['email'])[0]){
        $isid = 't';
        $_SESSION['resv'] = $row['resv'];
        $_SESSION['user_N'] = $row['user_N'];
        $_SESSION['user_id'] = $row['user_ID'];
        $_SESSION['user_name'] = $row['user_Name'];
        $_SESSION['user_type'] = 1;
      }
    }
  }
  else{
    echo "dberror";
  }

	if($isid == 't'){
		mysqli_close($conn);
		echo "<script>alert('로그인에 성공하였습니다!');</script>";
		echo "<script>window.location.replace('index.php');</script>";
	}
	else{
		$sql = "INSERT INTO users VALUES ('0','".$tmpid[0]."', 'google', '".$_POST['name']."', 'G".$_POST['name']."', '".$_POST['email']."', '1', '0')";
		$result = mysqli_query($conn, $sql);
		if($result){
			mysqli_close($conn);
			echo "<script>alert('회원등록에 성공하였습니다! 다시 로그인 해주세요.');</script>";
			echo "<script>window.location.replace('login.html');</script>";
		}
		else{
			echo "<script>alert('회원가입에 실패하였습니다!');</script>";
			echo mysqli_error($conn);
			mysqli_close($conn);
			echo "<script>window.location.replace('login.html');</script>";
		}

	 }

	echo "<script>window.location.replace('index.php');</script>";
?>

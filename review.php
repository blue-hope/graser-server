<?php
  $id = $_GET['i'];
  $conn = mysqli_connect("localhost", "root", "kwondong704","users");

  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }

  $sql2 = "SELECT * FROM stores";
  $result2 = mysqli_query($conn, $sql2);
  if($result2){
    while($row2 = mysqli_fetch_assoc($result2)){
      $store_N[] = $row2['store_N'];
    }
    $select_N = $store_N[$id];
  }
  $sql = "INSERT INTO reviews VALUES ('0', '".$_POST['reviewer']."', '".$select_N."', '".$_POST['review']."')";
  $result = mysqli_query($conn, $sql);

  $sql3 = "UPDATE stores SET reviews = reviews + 1 where store_N = ".$select_N." ";
  $result3 = mysqli_query($conn, $sql3);
  if($result3){
    echo "<script>alert('리뷰 작성이 완료 되었습니다!');</script>";
    echo "<script>window.location = 'storemore.php?i=".$id."';</script>";
  }



 ?>

<?php
 $CLIENT_ID     = "15285051117635b48ab62f850b0dba96";
 $REDIRECT_URI  = "http://localhost/kakao.php";
 $TOKEN_API_URL = "https://kauth.kakao.com/oauth/token";
 $CONN_API_URL = "https://kapi.kakao.com/v1/user/signup";

 $code   = $_GET["code"];
 $params = sprintf( 'grant_type=authorization_code&client_id=%s&redirect_uri=%s&code=%s', $CLIENT_ID, $REDIRECT_URI, $code);

 $opts = array(
   CURLOPT_URL => $TOKEN_API_URL,
   CURLOPT_SSL_VERIFYPEER => false,
   CURLOPT_SSLVERSION => 1, // TLS
   CURLOPT_POST => true,
   CURLOPT_POSTFIELDS => $params,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_HEADER => false
 );

 $curlSession = curl_init();
 curl_setopt_array($curlSession, $opts);
 $accessTokenJson = curl_exec($curlSession);
 curl_close($curlSession);
 $data = json_decode($accessTokenJson, false);
 $token = $data->access_token;

 $api_url = 'https://kapi.kakao.com/v2/user/me';

 $opts = array(
   CURLOPT_URL => $TOKEN_API_URL,
   CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSLVERSION => 1, // TLS
   CURLOPT_POST => true,
   CURLOPT_POSTFIELDS => $params,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_HEADER => false
 );

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $api_url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
 $response = curl_exec($ch);

 $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 curl_close($ch);


  if (!$response) {
 echo 'no response';
  exit;
 }
 $data = json_decode($response, false);
 var_dump($data->properties->nickname);

 session_start();

 $conn = mysqli_connect("localhost","root","kwondong704","users");

 if(!$conn){
   print "Error - Could not connect to MySQL: ".mysqli_error();
   exit;
 }
 $sql = "SELECT * FROM users WHERE user_PW = 'kakaotalk'";
 $isid = 'f';
 $result = mysqli_query($conn, $sql);
 if($result){
   while($row = mysqli_fetch_assoc($result)){
     if($row['user_ID'] == $data->id){
       $isid = 't';
       $_SESSION['resv'] = $row['resv'];
       $_SESSION['user_N'] = $row['user_N'];
       $_SESSION['user_id'] = $data->id;
       $_SESSION['user_name'] = $data->properties->nickname;
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
   $sql = "INSERT INTO users VALUES ('0','".$data->id."', 'kakaotalk', '".$data->properties->nickname."', 'K".$data->properties->nickname."', '".$data->id."', '1', '0')";
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


?>

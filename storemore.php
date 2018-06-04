<!DOCTYPE HTML>
<?php session_start();
$id = $_GET['i'];
$conn = mysqli_connect("localhost", "root", "kwondong704","users");
if(!$conn){
  print "Error - Could not connect to MySQL: ".mysqli_error();
  exit;
}
$isdate = 't';
$sql = "SELECT * FROM stores";
$result = mysqli_query($conn, $sql);
if($result){
  while($row = mysqli_fetch_assoc($result)){
    $store_name[] = $row['store'];
    $ppl[] = $row['ppl'];
    $txt[] = $row['txt'];
    $tag[] = $row['tag'];
    $lat[] = $row['lat'];
    $lng[] = $row['lng'];
    $review_num[] = $row['reviews'];
    $store_N[] = $row['store_N'];
    $love[] = $row['love'];
  }
  $select_name = $store_name[$id];
  $select_ppl = $ppl[$id];
  $select_txt = $txt[$id];
  $select_lat = $lat[$id];
  $select_lng = $lng[$id];
  $select_num = $review_num[$id];
  $select_N = $store_N[$id];
  $select_love = $love[$id];

  if($tag[$id] == '1')
    $select_tag = '고기구이';
  elseif($tag[$id] == '2')
    $select_tag = '치킨';
  elseif($tag[$id] == '3')
    $select_tag = '막걸리';
  elseif($tag[$id] == '4')
    $select_tag = '양주';
  elseif($tag[$id] == '5')
    $select_tag = '맥주';
  elseif($tag[$id] == '6')
    $select_tag = '포차식';
  elseif($tag[$id] == '7')
    $select_tag = '중국식';
  elseif($tag[$id] == '8')
    $select_tag = '일본식';
  elseif($tag[$id] == '9')
    $select_tag = '국물요리';
  elseif($tag[$id] == '10')
    $select_tag = '회';
  else {
    $select_tag = '그 외';
  }


  mysqli_close($conn);
}
else{
  mysqli_close($conn);
}

?>
<?php
  $reviewer = [];
  $reviewtxt = [];
  $conn = mysqli_connect("localhost", "root", "kwondong704","users");
  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }
  $sql = "SELECT * FROM reviews where store_N = '".$select_N."'";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){

    $reviewer_in_int[] = $row['user_N'];
    $reviewtxt[] = $row['txt'];

  }

  for($i = 0; $i < sizeof($reviewer_in_int); $i++){
    $sql2 = "SELECT * FROM users where user_N = '".$reviewer_in_int[$i]."'";
    $result2  = mysqli_query($conn, $sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $reviewer[] = $res2['user_Nick'];
    $reviewtype[] = $res2['user_Type'];
  }





 ?>
<html>
  <head>
    <title>
      그래서, 그레서
    </title>
    <meta charset="UTF-8">
    <!--viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--stylesheet-->
    <link rel="stylesheet" href="proto.css">

    <!--naver map & geolocation-->
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=siGiOdPbmbj3xrNIGsuH&submodules=geocoder"></script>
    <script type="text/javascript">
      function getLocation() {
        if (navigator.geolocation) { // GPS를 지원하면
          navigator.geolocation.getCurrentPosition(function(position) {
            init(position.coords.latitude, position.coords.longitude, 'm');
          }, function(error) {
            init(<?=$select_lat?>, <?=$select_lng?>, 's');
          }, {
            enableHighAccuracy: false,
            maximumAge: 0,
            timeout: Infinity
          });
        } else {
          alert('GPS를 지원하지 않습니다');
        }
      }

      function start(args)
      {
        if(args == 'm'){
          getLocation();
          var x2 = document.getElementById('dist-nav').children[0].children[0].style;
          var x1 = document.getElementById('dist-nav').children[0].children[1].style;
          x2.color = 'white';
          x2.backgroundColor = 'orange';
          x1.color = 'orange';
          x1.backgroundColor = 'white';
        }
        else if(args == 's'){
          init(<?=$select_lat?>, <?=$select_lng?>, 's');
          var x2 = document.getElementById('dist-nav').children[0].children[0].style;
          var x1 = document.getElementById('dist-nav').children[0].children[1].style;
          x1.color = 'white';
          x1.backgroundColor = 'orange';
          x2.color = 'orange';
          x2.backgroundColor = 'white';
        }
        else{
          init(<?=$select_lat?>, <?=$select_lng?>);
        }
      }
      function init(arg_lat, arg_lng, type)
      {
        var map = new naver.maps.Map('map', {
          center: new naver.maps.LatLng(arg_lat, arg_lng),
          zoom: 11,
          zoomControl: true,
          minZoom:11
        });

        var store = new naver.maps.Marker({
          position: new naver.maps.LatLng(arg_lat, arg_lng),
          map: map
        });

        if(type == 'm'){
          var str = [
                '<div class="iw_inner">',
                '   <h3>내 위치</h3>',
                '</div>'
            ].join('');
          setName(str, store);
        }
        else if(type == 's'){
          var str = [
                '<div class="iw_inner">',
                '   <h3><?=$select_txt?></h3>',
                '</div>'
            ].join('');
          setName(str, store);
        }

      }

      function setName(contentString, where)
      {
        var infoWindow = new naver.maps.InfoWindow({
          content: contentString
        });

        naver.maps.Event.addListener(where, "click", function(e) {
          if (infoWindow.getMap()) {
            infoWindow.close();
          } else {
            infoWindow.open(map, where);
          }
        });
      }

      addEventListener("load",getLocation, false);
      addEventListener("load", start, false);

    </script>

    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:700" rel="stylesheet">

    <!--icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
      body{
        font-family: 'Nanum Gothic', sans-serif;
      }
      h1{
        text-align: center;
        color: orange;
        font-size: 14px;
        margin: 3px;
      }
      div.more
  	  {
    	  width: 70%;
    	  margin-left: 15%;
    	  margin-top: 10px;
    	  border: 1px solid orange;
    	  text-align: center;
    	  color: orange;
  	  }
      .kback
      {
        background-color: orange;
        color: white;
        border: 1px solid white;
        text-align: center;
        width: 80px;
      }
      .kedit
      {
        background-color: orange;
        color: white;
        border: 1px solid white;
        text-align: center;
        width: 80px;
      }

      ul{
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        color: orange;
        width: 100%;
      }

      li{
        float: right;
        width: 60px;
      }
      div.dist-nav ul{
        border: 1px solid orange
      }

      div.dist-nav ul li{
        text-align: center;
      }

      div.dist-nav ul li#navleft{
        border-right: 1px solid orange
      }
    </style>

  </head>

  <body>
    <header>
      <nav>
        <ul style = 'height: 48px;'>
          <li id = 'logo'><a href = 'index.php'>logo</a></li>
          <?php
          if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
            echo "<li style='float: right' id = 'login'><a href = 'login.html'><i class = 'material-icons'>person</i></a></li>";
          } else {
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['user_name'];
            echo "<li style = 'float: right; height: 48px;' id = 'logout'><a href = 'logout.php'><i class = 'material-icons'>lock_open</i></a></li>";
            echo "<li style = 'float: right; color: white;'><a style = 'padding-left: 7px; padding-right: 7px; margin: 0;'>".$user_name." 님</a></li>";
          }
          ?>
        </ul>
      </nav>
    </header>
    <article id = 'main_info'>
      <div id = 'intro'>
          <br/><br/>
          <h1>지점정보</h1>
          <div class = 'more' style = 'background-color: orange; color: white;'>가게명: <?=$select_name?></div>
          <div class = 'more'>최대인원: <?=$select_ppl?></div>
          <div class = 'more'>가게공지: <br><textarea rows = '10' cols = '25' value = '' style = 'color: black;' onclick="this.value=''"><?=$select_txt?></textarea></div>
          <div class = 'more'>태그: <?=$select_tag?></div>
          <br>
          <div class = 'more' style = 'background-color: orange; color: white;'>위치확인</div>
          <div class = 'dist-nav' id = 'dist-nav'>
            <ul>
              <li style = 'width: 50%;' onclick = "start('m')">내위치</li>
              <li id = 'navleft' style = 'width: 50%;' onclick = "start('s')">가게위치</li>
            </ul>
          </div>
          <div id ="map" style = "width:100%;height:300px;"></div>
          <br>
          <div class = 'more' style = 'background-color: orange; color: white; margin-bottom: 0; border-bottom: none;'>리뷰</div>
          <div class = 'more' style = 'background-color: orange; color: white; margin-bottom: 0; margin-top: 0; border-bottom: none;'>( 점주님 리뷰는 분홍색입니다 )</div>
          <?php
            echo "<div class = 'more' style = 'margin-top: 0; border-top: none;'>리뷰수: ".sizeof($review_num)."</div>";
           ?>
          <?php
          if($review_num == 0){
            echo "<div id = 'review' style = 'width: 100%; border: 1px solid orange'><h1 style = 'color: orange;'>아직 등록된 리뷰가 없습니다!</h1><h1 style = 'color: orange;'>리뷰를 등록해주세요!</h1></div>";
          }
          else{
            for($i = 0; $i < sizeof($reviewtxt); $i++){
              if($reviewtype == '0'){
                $str = "";
                $str = $str."<div id = 'review' style = 'width: 100%; border: 1px solid orange; color: orange;'><span style = 'background-color: orange; color: white;'>";
                $str = $str."작성자: ".$reviewer[$i]."&nbsp;</span><span>리뷰:  ".$reviewtxt[$i]."</span>";
                $str = $str."</div>";
                echo $str;
              }
              else{
                $str = "";
                $str = $str."<div id = 'review' style = 'width: 100%; border: 1px solid orange; color: orange;'><span style = 'background-color: #fa8072; color: white;'>";
                $str = $str."작성자: ".$reviewer[$i]."&nbsp;</span><span>리뷰:  ".$reviewtxt[$i]."</span>";
                $str = $str."</div>";
                echo $str;
              }
            }
          }
          ?>
          <br><br>
          <div class = "kback" style = 'float: left;'><a href = 'find.php' style = 'color: white;'>뒤로가기</a></div>
          <div class = "kedit" style = 'float: right; color: white;' onclick = 'review()'>리뷰쓰기</div>
          <div style = 'width: 50%; margin: 0 auto;' ><input id = "reviewin" type = 'txt' value = '' maxlength = '30' style = 'width: 100%;' placeholder = '여기에 리뷰를 써주세요!'></input></div>

          <br><br>
      </div>

    </article>
    <footer>
      <nav>
        <ul style = 'height: 56px;'>
          <li id = 'index'><a href = 'index.php'><i class='material-icons'>assignment</i></a></li>
          <li id = 'find' style = 'background-color: orange;'><a href = 'find.php'><i class='material-icons' style = 'color: white;'>pageview</i></a></li>
          <li id = 'mypage'><a href = 'mypage.php'><i class='material-icons'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a href = 'more.php'><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
    <script>
      function review(){
        var x = document.getElementById('reviewin').value;
        var form = document.createElement("form");
    		form.setAttribute("method", "POST");
    		form.setAttribute("action", "review.php?i=<?=$id?>");
    		var hiddenField = document.createElement("input");
    		hiddenField.setAttribute("type", "hidden");
    		hiddenField.setAttribute("name", "reviewer");
    		hiddenField.setAttribute("value", <?=$_SESSION['user_N']?>);
    		form.appendChild(hiddenField);
    		var hiddenField1 = document.createElement("input");
    		hiddenField1.setAttribute("type", "hidden");
    		hiddenField1.setAttribute("name", "review");
    		hiddenField1.setAttribute("value", x);
    		form.appendChild(hiddenField1);
    		document.body.appendChild(form);
    		form.submit();
      }
    </script>
  </body>

</html>

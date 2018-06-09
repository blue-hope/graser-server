<!DOCTYPE HTML>
<?php session_start();?>
<?php
  $conn = mysqli_connect("localhost", "root", "kwondong704","users");
  $store_name = "";
  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }

  $sql = "SELECT * FROM stores WHERE user_N = '".$_SESSION['user_N']."'";
  $result = mysqli_query($conn, $sql);
  $res = mysqli_fetch_assoc($result);
  if($result){
    $store_name = $res['store'];
    $store_ppl = $res['ppl'];
    $store_txt = $res['txt'];
    $store_tag = $res['tag'];
  }
  else{
    echo "<script>window.location.replace('mypage.php');</script>";
    mysqli_close($conn);
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

    <!--naver map-->
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=siGiOdPbmbj3xrNIGsuH&submodules=geocoder"></script>
    <script type="text/javascript">
      function start()
      {
          init();
      }
      function init()
      {
        var map = new naver.maps.Map('map', {
          center: new naver.maps.LatLng(<?=$_GET['lat']?>, <?=$_GET['lng']?>),
          zoom: 11,
          zoomControl: true,
          minZoom:11
        });
        var store = new naver.maps.Marker({
          position: new naver.maps.LatLng(<?=$_GET['lat']?>, <?=$_GET['lng']?>),
          map: map
        });
        var str = [
              '<div class="iw_inner">',
              '   <h3><?=$store_txt?></h3>',
              '</div>'
          ].join('');
        setName(str, store);
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
          <h1>지점관리</h1>
          <div class = 'more'>가게명: <?=$store_name?></div>
          <div class = 'more'>최대인원: <?=$store_ppl?></div>
          <div class = 'more'>가게공지: <br><textarea rows = '10' cols = '25' value = '' style = 'color: black;' onclick="this.value=''"><?=$store_txt?></textarea></div>
          <div class = 'more'>태그: <?=$store_tag?></div>
          <div class = 'more'>위치확인</div>
          <div class = 'more'><div id ="map" style = "width:100%;height:300px;"></div></div>
          <div class = "kback" style = 'float: left;'><a href = 'mypage.php' style = 'color:white;'>뒤로가기</a></div>
          <div class = "kedit" href = '' style = 'float: right;'>공지수정</div>
          <br><br>
      </div>

    </article>
    <footer>
      <nav>
        <ul style = 'height: 56px;'>
          <li id = 'index'><a href = 'index.php'><i class='material-icons'>assignment</i></a></li>
          <li id = 'find'><a href = 'find.php'><i class='material-icons'>pageview</i></a></li>
          <li id = 'mypage' style = 'background-color: orange;'><a href = 'mypage.php'><i class='material-icons' style = 'color: white;'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a href = 'more.php'><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
  </body>

</html>

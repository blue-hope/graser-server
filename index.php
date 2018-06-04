<!DOCTYPE HTML>
<?php session_start(); ?>
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
        color: white;
        font-size: 14px;
        margin: 3px;
      }
      h2{
        text-align: left;
        /* color: #FFC079; */
        color: orange;
        font-size: 14px;
        margin-left: 14px;
        margin-top: 0;
      }
      blockquote{
        text-align: left;
        color: white;
        font-size: 10px;
        margin-left: 14px;
      }
      div#main_info div{
        margin-top: 0;
        margin-bottom: 0;
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
      <?php
      if(isset($_SESSION['user_id'])&&isset($_SESSION['user_name'])) {
        echo "<div id = 'intro_main' style = 'background-color: orange; border-top: 1px solid white;'>";
        echo "<br><br>";
        echo "<h1>".$_SESSION['user_name']."님, 그레서 이용은 즐거우신가요?</h1>";
        echo "<br><br>";
        echo "</div>";
      }else{
        echo "<div id = 'intro_main' style = 'background-color: orange; border-top: 1px solid white;'>";
        echo "<br><br>";
        echo "<h1>예약과 리뷰를 편하게!</h1>";
        echo "<h1>그래서, 그레서</h1>";
        echo "<br><br>";
        echo "</div>";
      }
      ?>

      <div id = 'intro'>
        <div id = 'info' style = 'border-top: 1px solid white;'>
          <br>
          <h2>처음 맛보는 손쉬운 단체예약</h2>
          <br>
          <blockquote>
            '그레서'를 통해 구글맵 api를 통해 <br> 사용자 주변의 원하시는 음식점에 <br> 바로 접속하실 수 있습니다.
          </blockquote>
          <blockquote>
            또한, 간단한 날짜 기입을 통해 <br> 사용자가 원하는 날짜에 <br> 예약이 있는지 알아보고 <br> 예약을 할 수 있습니다.<br>
          </blockquote>
          <blockquote>
            이토록 손쉬운 단체예약, <br>지금 당장 사용해보세요!
          </blockquote>
          <br>
        </div>
        <div id = 'info_2' style = 'border-top: 1px solid white;'>
          <br>
          <h2>잊을 수 없는 그곳의 추억</h2>
          <br>
          <blockquote>
            '그레서'를 통해 자신의 소중한 추억을 간직하세요 <br> 사용자가 방문한 음식점에 대한 후기를 <br> 그레서의 리뷰기능을 통해
            <br>바로 남길 수 있습니다.
          </blockquote>
          <br>
        </div>
        <div id = 'info_3' style = 'border-top: 1px solid white;'>
          <br>
          <h2>그레서의 오늘의 추천</h2>
          <br>
          <blockquote>
            '그레서'를 통해 자신의 소중한 추억을 간직하세요 <br> 사용자가 방문한 음식점에 대한 후기를 <br> 그레서의 리뷰기능을 통해
            <br>바로 남길 수 있습니다.
          </blockquote>
          <br>
        </div>
        <div id = 'info_4'>
        </div>
      </div>

    </article>
    <footer>
      <nav>
        <ul style = 'height: 56px;'>
          <li id = 'index' style = 'background-color: orange;'><a href = 'index.php'><i class='material-icons' style = 'color: white;'>assignment</i></a></li>
          <li id = 'find'><a href = 'find.php'><i class='material-icons'>pageview</i></a></li>
          <li id = 'mypage'><a href = 'mypage.php'><i class='material-icons'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a href = 'more.php'><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
  </body>

</html>

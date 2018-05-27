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
      div#main_info div{
        margin-top: 0;
        margin-bottom: 0;
      }
      div#row div{
        display: inline;
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
            echo "<li style='float: right;' id = 'login'><a href = 'login.html'><i class = 'material-icons'>person</i></a></li>";
          } else {
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['user_name'];
            echo "<li style = 'float: right' id = 'logout'><a href = 'logout.php'><i class = 'material-icons'>lock_open</i></a></li>";
            echo "<li style = 'float: right; color: white;'><a style = 'padding-left: 7px; padding-right: 7px; margin: 0;'>".$user_name." 님</a></li>";
          }
          ?>
        </ul>
      </nav>
    </header>
    <article id = 'main_info'>
      <div id = 'intro'>
        <div id = 'query' style = 'border-top: 1px solid white; background-color: orange; width: 100%;'>
          <form action="find_query.php" method="post">
            <br>
            <h1>예약할 장소가 어딘가요?</h1>
            <br>
            <div style = 'margin-left: 20%; margin-right: 0;'>
              <input type = 'text' size = '20' autocomplete="on" placeholder="음식점/술집 이름으로 찾기"/>
            </div>
          </form>
          <br>
          <h1>혹은, 태그를 이용해서 찾으실 수 있습니다</h1>
          <div id = 'tag' style = 'border-top: 1px solid white;'>
            <div class = 'row'>
              <div class="col-xs-4" style = 'padding: 0;' id = 'f1'>
                <br><br>
                <h1>양식</h1>
                <br><br>
              </div>
              <div class="col-xs-4" style = 'padding: 0;' id = 'f2'>
                <br><br>
                <h1>중식</h1>
                <br><br>
              </div>
              <div class="col-xs-4" style = 'padding: 0;' id = 'f3'>
                <br><br>
                <h1>한식</h1>
                <br><br>
              </div>
            </div>
          </div>
        </div>

      </div>
    </article>
    <footer>
      <nav>
        <ul style = 'height: 56px;'>
          <li id = 'find' style = 'background-color: orange;'><a href = 'find.php'><i class='material-icons' style = 'color: white;'>pageview</i></a></li>
          <li id = 'review'><a href = 'review.php'><i class='material-icons'>assignment</i></a></li>
          <li id = 'mypage'><a href = 'mypage.php'><i class='material-icons'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a href = 'more.php'><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
  </body>

</html>

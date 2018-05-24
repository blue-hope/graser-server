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
        color: orange;
        font-size: 14px;
        margin: 3px;
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
            echo "<li style='float: right' id = 'login'><a href = 'login.php'><i class = 'material-icons'>person</i></a></li>";
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
          한중아 여기에다가 form 작성하면 돼 그리고 action 은 joinOK.php로 post로 넘겨 알았지?
          내가 고른건 ID password name nickname phone mail birth 이거니까 이거 유효성검사 알아서하고
          잘하리라 믿는다 ㅎㅎ
      </div>

    </article>
    <footer>
      <nav>
        <ul style = 'height: 56px;'>
          <li id = 'find'><a href = 'find.php'><i class='material-icons'>pageview</i></a></li>
          <li id = 'review'><a href = 'review.php'><i class='material-icons'>assignment</i></a></li>
          <li id = 'mypage'><a><i class='material-icons'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
  </body>

</html>

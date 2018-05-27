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
    <script src="joinCheck.js"></script>

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
        <br>
        <p style='margin: 5px 10px; text-align: center; font-size: 16px;'>회원가입</p>
        <div class = 'container' style = 'margin-left: 10%; margin-right: 10%;'>
          <form method="post" action="joinOK.php" style='text-align: center; padding: 2% 0;'>
            <p>당신의 소속은?</p>
            <p>
              <input type="radio" name="user_type" value="0" checked> 손님
              <input type="radio" name="user_type" value="1"> 점주님<br>
            </p>
            <p>ID : <br> <input id="ID" type="text" name = "user_id" required></p>
            <p id="eID" style="color:red"></p>
            <p>PW : <br> <input id="PW" type="password" name = "user_pw" required></p>
            <p id="ePW" style="color:red"></p>
            <p>이름 : <br> <input id="NAME" type="text" name = "user_name" required></p>
            <p id="eNAME" style="color:red"></p>
            <p>닉네임 : <br> <input id="Nick" type="text" name = "user_nick" required></p>
            <p id="eNick" style="color:red"></p>
            <p>전화번호 : <br> <input id="PHN" type="tel" placeholder="01012345678" name = "user_phone" required></p>
            <p id="ePHN" style="color:red"></p>
            <p>생일 : <br> <input id="BTN" type="number" placeholder="YYMMDD" name = "user_birth" required></p>
            <p id="eBTN" style="color:red"></p>
            <p>이메일 : <br> <input id="EMN" type="text" name = "user_email" required></p>
            <p id="eEMN" style="color:red"></p>
            <p><input id="joinbutton" type="submit" value="가입" disabled></p>
          </form>
        </div>
      </div>

    </article>
    <footer>
      <nav>
        <ul style = 'height: 56px;'>
          <li id = 'find'><a href = 'find.php'><i class='material-icons'>pageview</i></a></li>
          <li id = 'review'><a href = 'review.php'><i class='material-icons'>assignment</i></a></li>
          <li id = 'mypage'><a href = 'mypage.php'><i class='material-icons'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
  </body>

</html>

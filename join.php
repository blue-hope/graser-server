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
        <form method="post" action="joinOK.php">
          <p>ID : <input id="ID" type="text" required></p>
          <p id="eID" style="color:red"></p>
          <p>PW : <input id="PW" type="password" required></p>
          <p id="ePW" style="color:red"></p>
          <p>Name : <input id="NAME" type="text" required></p>
          <p id="eNAME" style="color:red"></p>
          <p>NickName : <input id="Nick" type="text" required></p>
          <p id="eNick" style="color:red"></p>
          <p>Phone : <input id="PHN" type="tel" placeholder="01012345678" required></p>
          <p id="ePHN" style="color:red"></p>
          <p>Birth : <input id="BTN" type="number" placeholder="YYMMDD" required></p>
          <p id="eBTN" style="color:red"></p>
          <p>Email :  <input id="EMN" type="text" required></p>
          <p id="eEMN" style="color:red"></p>
          <p><input type="radio" name="gender" value="male" required> Male</p>
          <p><input type="radio" name="gender" value="female" required> Female</p>
          <p><input id="joinbutton" type="submit" value="Join" disabled></p>
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

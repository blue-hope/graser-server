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
        <ul>
          <li id = 'logo'><a href = 'index.html'>logo</a></li>
          <li style='float: right' id = 'login'><a href = 'login.html'><i class = 'material-icons'>person</i></a></li>
        </ul>
      </nav>
    </header>
    <article id = 'main_info'>
      <div id = 'intro'>
          <br/><br/>
            <div id = 'login-box'>
              <div class = 'container'>
                <h1>Email 로그인</h1>
                <p id = 'emailloginbox'></p>
                <div style = 'margin-left: 10%;'>
                  <?php if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {?>
                  <form action="loginOK.php" method="post">
                    <p>ID<br><input type="text" name = 'user_id' style = 'color: black;'></p>
<<<<<<< HEAD
                    <p>PW<br><input type="password" name = 'user_pw' style = 'color: black;'></p>
=======
                    <p>PW<br><input type="password" name = 'user_id' style = 'color: black;'></p>
>>>>>>> 7c8a7300813e37f7aad5c41e002db6759d3f6e25
                    <p style = 'color: black; font-size: 15px;'><input type="submit" value="로그인"></p>
                  </form>
                <?php }?>
                </div>
              </div>
              <div class = 'container'>
                <h1>kakaotalk</h1>
              </div>
              <div class = 'container'>
                <h1>google</h1>
              </div>
            </div>
<<<<<<< HEAD
            <h1><a href = 'join.php'>아직 회원이 아니신가요?</a></h1>
=======
            <h1><a>아직 회원이 아니신가요?</a></h1>
>>>>>>> 7c8a7300813e37f7aad5c41e002db6759d3f6e25
      </div>

    </article>
    <footer>
      <nav>
        <ul style='margin-bottom: 0;'>
          <li id = 'find'><a href = 'find.html'><i class='material-icons'>pageview</i></a></li>
          <li id = 'review'><a href = 'review.html'><i class='material-icons'>assignment</i></a></li>
          <li id = 'mypage'><a><i class='material-icons'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>

  </body>

</html>

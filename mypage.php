<!DOCTYPE HTML>
<?php session_start();?>
<?php
  $conn = mysqli_connect("localhost", "root", "kwondong704","users");
  $store_name = "";
  if(!$conn){
    print "Error - Could not connect to MySQL: ".mysqli_error();
    exit;
  }

  if(!isset($_SESSION['user_N'])){
    echo "<script>alert('로그인이 필요한 서비스입니다.');</script>";
    echo "<script>window.location.replace('login.html');</script>";
  }


  $sql = "SELECT * FROM stores WHERE user_N = '".$_SESSION['user_N']."'";
  $result = mysqli_query($conn, $sql);
  $res = mysqli_fetch_assoc($result);
  if($result){
    $store_name = $res['store'];
    $store_lat = $res['lat'];
    $store_lng = $res['lng'];
  }
  else{
    echo "<script>alert('데이터 베이스를 읽는데 실패했습니다!');</script>";
    echo "<script>window.location.replace('mypage.php');</script>";
    mysqli_close($conn);
  }

  $sql2 = "SELECT * FROM resvs WHERE resvto = '".$_SESSION['user_N']."' and checked = false";//점주
  $sql3 = "SELECT * FROM resvs WHERE user_N = '".$_SESSION['user_N']."'";//손님
  if($_SESSION['resv'] != '0'){
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    if($result2){
      while($row = mysqli_fetch_assoc($result2)){
        $resv_m[] = $row['month'];
        $resv_d[] = $row['day'];
        $resv_y[] = $row['year'];
        $resv_expl[] = $row['expl'];
      }
      if(!isset($resv_m)){
        $resv_num = 0;
        $resv_m = [];
        $resv_d = [];
        $resv_y = [];
        $resv_expl = [];
      }
      else
        $resv_num = sizeof($resv_m);

    }
    else{
      echo "<script>alert('데이터 베이스를 읽는데 실패했습니다!');</script>";
      echo "<script>window.location.replace('mypage.php');</script>";
    }
    if($result3){
      while($row = mysqli_fetch_assoc($result3)){
        $uresv_m[] = $row['month'];
        $uresv_d[] = $row['day'];
        $uresv_y[] = $row['year'];
        $uresv_expl[] = $row['expl'];
        $uresv_check[] = $row['checked'];
      }
      if(!isset($uresv_m)){
        $uresv_num = 0;
        $uresv_m = [];
        $uresv_d = [];
        $uresv_y = [];
        $uresv_expl = [];
        $uresv_check = [];
      }
      else
        $uresv_num = sizeof($uresv_m);
    }
  }
  else{
    $resv_num = 0;
    $resv_m = [];
    $resv_d = [];
    $resv_y = [];
    $resv_expl = [];
    $uresv_num = 0;
    $uresv_m = [];
    $uresv_d = [];
    $uresv_y = [];
    $uresv_expl = [];
    $uresv_check = [];
  }
  mysqli_close($conn);
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
    <link rel="stylesheet" href="day.css">

    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:700" rel="stylesheet">

    <!--icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--datepicker-->
    <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>

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
      div.open
      {
        width: 70%;
        margin-left: 15%
      }

      .k
    	{
    		background-color: orange;
    		color: white;
    		border: 1px solid white;
    		text-align: center;
    		width: 40px;
    		margin-left: 80%;
    	}
      .k:hover
  	  {
    		background-color: white;
    		color: orange;
    		border: 1px solid orange;
    		text-align: center;
    		width: 40px;
    		margin-left: 80%;
  	  }
      h2#title{
        font-size: 13px;
        border: none;
        padding-bottom: 2px;
        padding-left: 10%;
      }
      h2{
        font-size: 13px;
        borde: none;
        padding-bottom: 2px;
        padding-left: 10%;
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
          <?php
            if(isset($_SESSION['user_type'])){
              if($_SESSION['user_type'] == '0'){
                echo "<h1>손님계정 접속중</h1>";
                echo "<div class = 'more' onclick = 'res_info()'>현재 예약</div>";
                echo "<div class = 'open' id = 'res_info'></div>";
                echo "<div class = 'more'>리뷰 관리</div>";
                echo "<div class = 'open' id = 'review_manage'></div>";
                echo "<div class = 'more'>계정 관리</div>";
                echo "<div class = 'open' id = 'id_manage'></div>";
              }
              elseif($_SESSION['user_type'] == '1'){
                echo "<h1>점주님계정 접속중</h1>";
                if($_SESSION['resv'] == '0')
                  echo "<div class = 'more' onclick = 'res_in_info()'>예약관리</div>";
                else {
                  if($resv_num == 0)
                    echo "<div class = 'more' onclick = 'res_in_info()'>예약관리</div>";
                  else
                    echo "<div class = 'more' onclick = 'res_in_info()'>예약관리(".$resv_num.")</div>";
                }
                echo "<div class = 'open' id = 'res_in_info'></div>";
                echo "<div class = 'more' onclick = 'res_upload()'>예약정보업로드</div>";
                echo "<div class = 'open' id = 'res_upload'></div>";
                echo "<div class = 'more' onclick = 'res_info()'>지점관리</div>";
                echo "<div class = 'open' id = 'res_info'></div>";
                echo "<div class = 'more'>리뷰 관리</div>";
                echo "<div class = 'open' id = 'review_manage'></div>";
                echo "<div class = 'more'>계정관리</div>";
                echo "<div class = 'open' id = 'id_manage2'></div>";
              }
              elseif($_SESSION['user_type'] == '2'){
                echo "<h1>관리자계정 접속중</h1>";
              }
            }
            else{
              echo "<script>alert('로그인이 필요한 서비스입니다.');</script>";
              echo "<script>window.location.replace('login.html');</script>";
            }
          ?>
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

    <script>
      function res_upload(){
        var x = <?=$_SESSION['resv']?>;
        var ele = document.getElementById('res_upload');
        var ele2 = document.getElementsByClassName('more');
        if(x == 0){
          ele.innerHTML = "<h1>등록된 지점이 없습니다</h1><h1>등록하시겠습니까?</h1> \r\n <div class = \"k\" onclick = 'window.location=\"store.php\"'>등록</div><div class = \"k\" onclick = \"res_info()\">닫기</div>";
        }
        else{
          ele.innerHTML = "<h1>현재 등록된 가게는</h1> \r\n<h1><?=$store_name?>입니다.</h1> \r\n <h1>예약 정보를 올리세요</h1><h1 style = 'color: orange;'>날짜: <input type = 'text' autocomplete = 'off' id = 'datepicker' name = 'date' style ='color: blue;'/><br>인원: <input type = 'number' id = 'ppl' name = 'ppl' style ='color: blue;'/><br>설명: <input tyype = 'text' id = 'dateexpl' name = 'dateexpl' style = 'color: blue;' maxlength='10' placeholder= '최대10자 내로 써주세요'/></h1><div class = \"k\" onclick = 'regs_date()'>등록</div>";
        }
        if(ele2[1].style.backgroundColor == "white"){
          ele2[1].style.backgroundColor = "orange";
          ele2[1].style.color = "white";
          ele.style.border = "1px solid orange";
        }
        else{
          ele2[1].style.backgroundColor = "white";
          ele2[1].style.color = "orange";
          ele.innerHTML = "";
          ele.style.border = "";
        }


        /* create an array of days which need to be disabled */
       var disabledDays = [];

       /* utility functions */
       function nationalDays(date) {
         var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
         for (i = 0; i < disabledDays.length; i++) {
           if($.inArray((m+1) + '-' + d + '-' + y,disabledDays) != -1 || new Date() > date) {
             return [false];
           }
         }
         return [true];
       }

       function noWeekendsOrHolidays(date) {
         return nationalDays(date);
       }
       var today = new Date();
       var t_m = today.getMonth();
       var t_d = today.getDate();
       var t_y = today.getFullYear();
       /* create datepicker */
       jQuery(document).ready(function() {
         jQuery('#datepicker').datepicker({
           minDate: new Date(t_y, t_d, t_m),
           maxDate: new Date(parseInt(t_y)+1, t_d, t_m),
           dateFormat: 'DD, MM, d, yy',
           constrainInput: true,
           beforeShowDay: noWeekendsOrHolidays
         });
       });
      }
      function regs_date(){
        var ele = document.getElementById('datepicker').value;
        var ele2 = document.getElementById('dateexpl').value;
        var ele3 = document.getElementById('ppl').value;
        var x = ele.split(', ');
        var m = x[1];
        var d = x[2];
        var y = x[3];
        var txt = ele2;
        var ppl = ele3
        window.location.replace('putresv.php?m='+m+'&d='+d+'&y='+y+'&txt='+txt+'&ppl='+ppl);
      }
      function res_info(){
        var x = <?=$_SESSION['resv']?>;
        var y = <?=$_SESSION['user_type']?>;
        if(y == '0'){
          var ele = document.getElementById('res_info');
          var ele2 = document.getElementsByClassName('more');
          if(x == 0){
            ele.innerHTML = "<h1>현재 예약 정보가 없습니다</h1> \r\n <div class = \"k\" onclick = \"res_info()\">닫기</div>";
            if(ele2[0].style.backgroundColor == "white"){
              ele2[0].style.backgroundColor = "orange";
              ele2[0].style.color = "white";
              ele.style.border = "1px solid orange";
            }
            else{
              ele2[0].style.backgroundColor = "white";
              ele2[0].style.color = "orange";
              ele.innerHTML = "";
              ele.style.border = "";
            }
          }
          else{
            if('<?=$uresv_num?>' == '0')
              ele.innerHTML = "<h1>현재 예약 정보가 없습니다</h1> \r\n <div class = \"k\" onclick = \"res_info()\">닫기</div>";
            else {
              var uresv_y = <?=json_encode($uresv_y)?>;
              var uresv_m = <?=json_encode($uresv_m)?>;
              var uresv_d = <?=json_encode($uresv_d)?>;
              for(var i in uresv_m){
                {
                  if(uresv_m[i] == 'January')
                    uresv_m[i] = 1;
                  else if(uresv_m[i] == 'February')
                    uresv_m[i] = 2;
                  else if(uresv_m[i] == 'March')
                    uresv_m[i] = 3;
                  else if(uresv_m[i] == 'April')
                    uresv_m[i] = 4;
                  else if(uresv_m[i] == 'May')
                    uresv_m[i] = 5;
                  else if(uresv_m[i] == 'June')
                    uresv_m[i] = 6;
                  else if(uresv_m[i] == 'July')
                    uresv_m[i] = 7;
                  else if(uresv_m[i] == 'August')
                    uresv_m[i] = 8;
                  else if(uresv_m[i] == 'September')
                    uresv_m[i] = 9;
                  else if(uresv_m[i] == 'October')
                    uresv_m[i] = 10;
                  else if(uresv_m[i] == 'November')
                    uresv_m[i] = 11;
                  else if(uresv_m[i] == 'December')
                    uresv_m[i] = 12;
                  else {
                    uresv_m[i] = 0;
                  }
                }
              }
              var uresv_expl = <?=json_encode($uresv_expl)?>;
              var uresv_check = <?=json_encode($uresv_check)?>;
              var falseN = 0;
              for(var i in uresv_check){
                if(uresv_check[i] == false){
                  falseN = parseInt(falseN)+1;
                }
              }
              var trueN = parseInt(<?=$uresv_num?>) - falseN;
              var inner = "<h1>현재 예약 대기수는 "+falseN+"개입니다.</h1> <br><h1>목록</h1><br>";
              for(var i = 0; i < <?=$uresv_num?>; i++){
                if(uresv_check[i] == false){
                  var num = parseInt(i)+1;
                  inner += "<div><h2 id = 'title' style = 'margin: 0;'>" + num + "번째 예약: " + uresv_expl[i] + "</h2><h2 style = 'margin: 0;'>" + uresv_y[i] + "년 " + uresv_m[i] + "월 " + uresv_d[i] + "일 </h2>";
                }
              }
              inner += "<br><hr><br>";
              inner += "<h1>지금까지 승인된 예약은 모두 "+trueN+"개입니다.</h1> <br><h1>목록</h1><br>";
              for(var i = 0; i < <?=$uresv_num?>; i++){
                if(uresv_check[i] == true){
                  var num = parseInt(i)+1;
                  inner += "<div><h2 id = 'title' style = 'margin: 0;'>" + num + "번째 예약: " + uresv_expl[i] + "</h2><h2 style = 'margin: 0;'>" + uresv_y[i] + "년 " + uresv_m[i] + "월 " + uresv_d[i] + "일 </h2>";
                }
              }
              ele.innerHTML = inner;
          }

          if(ele2[0].style.backgroundColor == "white"){
            ele2[0].style.backgroundColor = "orange";
            ele2[0].style.color = "white";
            ele.style.border = "1px solid orange";
          }
          else{
            ele2[0].style.backgroundColor = "white";
            ele2[0].style.color = "orange";
            ele.innerHTML = "";
            ele.style.border = "";
          }
        }
      }else if(y == '1'){
          var ele = document.getElementById('res_info');
          var ele2 = document.getElementsByClassName('more');

          if(x == 0){
            ele.innerHTML = "<h1>등록된 지점이 없습니다</h1><h1>등록하시겠습니까?</h1> \r\n <div class = \"k\" onclick = 'window.location=\"store.php\"'>등록</div><div class = \"k\" onclick = \"res_info()\">닫기</div>";
          }
          else{
            ele.innerHTML = "<h1>현재 등록된 가게는</h1> \r\n<h1><?=$store_name?>입니다.</h1> \r\n <div class = \"k\" onclick = 'window.location=\"storeinfo.php?lat=<?=$store_lat?>&lng=<?=$store_lng?>\"'>관리</div>";
          }
          if(ele2[2].style.backgroundColor == "white"){
            ele2[2].style.backgroundColor = "orange";
            ele2[2].style.color = "white";
            ele.style.border = "1px solid orange";
          }
          else{
            ele2[2].style.backgroundColor = "white";
            ele2[2].style.color = "orange";
            ele.innerHTML = "";
            ele.style.border = "";
          }
        }
      }
    </script>
    <script>
      function res_in_info(){
        var x = <?=$_SESSION['resv']?>;
        var ele = document.getElementById('res_in_info');
        var ele2 = document.getElementsByClassName('more');
        if(x == 0){
          ele.innerHTML = "<h1>등록된 지점이 없습니다</h1><h1>등록하시겠습니까?</h1> \r\n <div class = \"k\" onclick = 'window.location=\"store.php\"'>등록</div><div class = \"k\" onclick = \"res_info()\">닫기</div>";
          if(ele2[0].style.backgroundColor == "white"){
            ele2[0].style.backgroundColor = "orange";
            ele2[0].style.color = "white";
            ele.style.border = "1px solid orange";
          }
          else{
            ele2[0].style.backgroundColor = "white";
            ele2[0].style.color = "orange";
            ele.innerHTML = "";
            ele.style.border = "";
          }
        }
        else{
          if('<?=$resv_num?>' == '0')
            ele.innerHTML = "<h1>현재 예약 대기 수는 0개입니다.</h1>";
          else {
            var resv_y = <?=json_encode($resv_y)?>;
            var resv_m = <?=json_encode($resv_m)?>;
            var resv_d = <?=json_encode($resv_d)?>;
            for(var i in resv_m){
              {
                if(resv_m[i] == 'January')
                  resv_m[i] = 1;
                else if(resv_m[i] == 'February')
                  resv_m[i] = 2;
                else if(resv_m[i] == 'March')
                  resv_m[i] = 3;
                else if(resv_m[i] == 'April')
                  resv_m[i] = 4;
                else if(resv_m[i] == 'May')
                  resv_m[i] = 5;
                else if(resv_m[i] == 'June')
                  resv_m[i] = 6;
                else if(resv_m[i] == 'July')
                  resv_m[i] = 7;
                else if(resv_m[i] == 'August')
                  resv_m[i] = 8;
                else if(resv_m[i] == 'September')
                  resv_m[i] = 9;
                else if(resv_m[i] == 'October')
                  resv_m[i] = 10;
                else if(resv_m[i] == 'November')
                  resv_m[i] = 11;
                else if(resv_m[i] == 'December')
                  resv_m[i] = 12;
                else {
                  resv_m[i] = 0;
                }
              }
            }
            var resv_expl = <?=json_encode($resv_expl)?>;
            var inner = "<h1>현재 예약 대기 수는 <?=$resv_num?>개입니다.</h1> <br><h1>목록</h1><br>";
            for(var i = 0; i < <?=$resv_num?>; i++){
              var num = parseInt(i)+1;
              inner += "<div><h2 id = 'title' style = 'margin: 0;'>" + num + "번째 예약: " + resv_expl[i] + "</h2><h2 style = 'margin: 0;'>" + resv_y[i] + "년 " + resv_m[i] + "월 " + resv_d[i] + "일 </h2>";
              inner += "<a style = 'font-size: 13px; margin: 0; padding-left: 10%; padding-bottom: 3px;' href = 'resv_permission.php?expl='" + resv_expl[i] + ">예약승인</a></div><hr>";
            }
            ele.innerHTML = inner;
          }

          if(ele2[0].style.backgroundColor == "white"){
            ele2[0].style.backgroundColor = "orange";
            ele2[0].style.color = "white";
            ele.style.border = "1px solid orange";
          }
          else{
            ele2[0].style.backgroundColor = "white";
            ele2[0].style.color = "orange";
            ele.innerHTML = "";
            ele.style.border = "";
          }
        }
      }
    </script>
  </body>

</html>

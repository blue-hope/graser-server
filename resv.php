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
 $sql2 = "SELECT * FROM resvs WHERE user_N = '".$_SESSION['user_N']."' and checked = 1";
 $result2 = mysqli_query($conn, $sql2);
 if($result && $result2){
   while($row = mysqli_fetch_assoc($result)){
     $store_name[] = $row['store'];
     $ppl[] = $row['ppl'];
   }
   $select_name = $store_name[$id];
   $select_ppl = $store_name[$id];

   while($row = mysqli_fetch_assoc($result2)){
     $resv_m[] = $row['month'];
     $resv_d[] = $row['day'];
     $resv_y[] = $row['year'];
     $resv_expl[] = $row['expl'];
   }

 }
 else{
   mysqli_close($conn);
 }
 if(!isset($resv_m)){
   $isdate = 'f';
   $resv_m = [];
   $resv_d = [];
   $resv_y = [];
   $resv_expl = [];
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

     <script>
       /* create an array of days which need to be disabled */
      if('<?=$isdate?>' == 't'){
        var resv_m = <?=json_encode($resv_m)?>;
        var resv_d = <?=json_encode($resv_d)?>;
        var resv_y = <?=json_encode($resv_y)?>;
        var resv_expl = <?=json_encode($resv_expl)?>;
        for(var i in resv_m)
        {
          if(resv_m[i] == 'January')
            resv_m[i] = '1';
          else if(resv_m[i] == 'February')
            resv_m[i] = '2';
          else if(resv_m[i] == 'March')
            resv_m[i] = '3';
          else if(resv_m[i] == 'April')
            resv_m[i] = '4';
          else if(resv_m[i] == 'May')
            resv_m[i] = '5';
          else if(resv_m[i] == 'June')
            resv_m[i] = '6';
          else if(resv_m[i] == 'July')
            resv_m[i] = '7';
          else if(resv_m[i] == 'August')
            resv_m[i] = '8';
          else if(resv_m[i] == 'September')
            resv_m[i] = '9';
          else if(resv_m[i] == 'October')
            resv_m[i] = '10';
          else if(resv_m[i] == 'November')
            resv_m[i] = '11';
          else if(resv_m[i] == 'December')
            resv_m[i] = '12';
          else {
            resv_m[i] = '0';
          }
        }
      }
      var disabledDays = [""];

      if('<?=$isdate?>' == 't'){
        for(var i in resv_m){
          var tmpDay = "";
          tmpDay += resv_m[i];
          tmpDay += "-";
          tmpDay += resv_d[i];
          tmpDay += "-";
          tmpDay += resv_y[i];
          disabledDays.push(tmpDay);
        }
      }

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
     </script>
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
         <div id = 'datepick'>
           <br>
           <br>
           <h1 style = 'color: orange;'>손쉬운 예약</h1>
           <br>
          <form action="resvOK.php" id = 'resvOKform' method="post">
           <h2>상호명</h2>
           <h2 style = 'color: blue;'><?=$select_name?></h2>
           <br>
           <h2>날짜입력</h2>
           <h2 style = 'color: blue;'><input type = 'text' id = 'datepicker' name = 'date' autocomplete = "off" /></h2>
           <br>
           <h2>인원입력</h2>
           <h2 style = 'color: blue;'><input type = 'number' class = 'datebox' name = 'inputppl' /></h2>
           <br>
           <h2>설명추가</h2>
           <h2 style = 'color: blue;'><input type = 'text' class = 'dateexpl' name = 'inputtxt' maxlength='10' placeholder= '최대10자 내로 써주세요'/></h2>
           <input type = 'submit' value = '제출' style = 'margin-left: 14px;'/>
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
           <li id = 'more' style = 'border-right: 0;'><a href = 'more.php'><i class='material-icons'>more</i></a></li>
         </ul>
       </nav>
     </footer>
   </body>

 </html>

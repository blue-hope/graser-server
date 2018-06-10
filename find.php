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

    <!--naver map-->
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=siGiOdPbmbj3xrNIGsuH&submodules=geocoder"></script>

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
        text-align: center;
        color: white;
        font-size: 14px;
        margin: 3px;
      }
      div#main_info div{
        margin-top: 0;
        margin-bottom: 0;
      }
  	  div.tag{
  		  border: 1px solid orange;
  		  background-color: white;
  		  color: orange;
  		  border-radius: 3px;
  		  padding-left: 2px;
  		  padding-right: 2px;
  		  text-align:center;
  		  display: inline-block;
  		  margin: 3px 1px;
  	  }
  	  div.tag:hover
  	  {
  		  border: 1px solid orange;
  		  color: white;
  		  background-color: orange;
  		  border-radius: 3px;
  		  padding-left: 2px;
  		  padding-right: 2px;
  		  text-align:center;
  		  margin: 3px 1px;
  	  }
  	  #tags
  	  {
  		  width: 90%;
  		  margin-left: 5%;
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
      div.expl div h1
      {
        color: black;
        text-align: left;
        font-size: 14px;
        padding-left: 2px;
        font-weight: bold;
      }
      div.expl div h2
      {
        color: black;
        text-align: left;
        font-size: 12px;
        padding-left: 2px;
      }
      div.expl div{
        background-color: white;
        height: 90px;
        border-top : 1px solid #a0a0a0;
        border-bottom : 1px solid #a0a0a0;
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

      a{
        text-decoration: none;
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
          <li id = 'logo'><a href = 'index.php'><img src = "img/mainicon.png" alt = "logo" style= "height: 35px;"></a></li>
          <?php
          if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
            echo "<li style='float: right;' id = 'login'><a href = 'login.html'><i class = 'material-icons'>person</i></a></li>";
            $isuser = 'f';
          } else {
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['user_name'];
            echo "<li style = 'float: right' id = 'logout'><a href = 'logout.php'><i class = 'material-icons'>lock_open</i></a></li>";
            echo "<li style = 'float: right; color: white;'><a style = 'padding-left: 7px; padding-right: 7px; margin: 0;'>".$user_name." 님</a></li>";
            $isuser = 't';
          }
          ?>
        </ul>
      </nav>
    </header>
    <article id = 'main_info'>
      <div id = 'intro'>
        <div id = 'query' style = 'border-top: 1px solid white; background-color: orange; width: 100%;'>
          <br>
          <h1>예약할 장소</h1>
          <br>
          <div style = 'margin-left: 15%; margin-right: 0;'>
            <input type = 'text' style='margin-left: 8%;' id = 'search' onkeyup="func1('0')" autocomplete="on" placeholder="음식점/술집 이름으로 찾기"/>
          </div>
          <br>

        </div>
        <div id = 'tag_query' style = 'border-top: 1px solid white; background-color: white; width: 100%;'>
          <h1 style = "color: orange;">혹은, 태그를 이용해서 찾으실 수 있습니다</h1>
          <div id = 'tags'>
    			  <div class = "tag" id = "tag1" onclick ="func1('1')">고기구이</div>
    			  <div class = "tag" id = "tag2" onclick ="func1('2')">치킨</div>
    			  <div class = "tag" id = "tag3" onclick ="func1('3')">막걸리</div>
    			  <div class = "tag" id = "tag4" onclick ="func1('4')">양주</div>
    			  <div class = "tag" id = "tag5" onclick ="func1('5')">맥주</div>
    			  <div class = "tag" id = "tag6" onclick ="func1('6')">포차식</div>
    			  <div class = "tag" id = "tag7" onclick ="func1('7')">중국식</div>
    			  <div class = "tag" id = "tag8" onclick ="func1('8')">일본식</div>
    			  <div class = "tag" id = "tag9" onclick ="func1('9')">국물요리</div>
    			  <div class = "tag" id = "tag10" onclick ="func1('10')">회</div>
    			  <div class = "tag" id = "tag11" onclick ="func1('11')">그 외</div>
          </div>
        </div>
      </div>
      <br>
      <div class = 'more'>등록되어 있는 가게</div>
      <br>
      <div class = 'dist-nav' id = 'dist-nav'>
        <ul>
          <li style = 'width: 25%;' onclick = "func1('-4')">200명~</li>
          <li id = 'navleft' style = 'width: 25%;' onclick = "func1('-3')">100~200명</li>
          <li id = 'navleft' style = 'width: 25%;' onclick = "func1('-2')">30~100명</li>
          <li id = 'navleft' style = 'width: 25%;' onclick = "func1('-1')">모두보이기</li>
        </ul>
      </div>
      <div id="map" style = "width:100%;height:400px;"></div>
      <br>

      <div class = 'more' style = 'background-color: #dbe6ec; border: 1px solid white; margin: none;'>가게 목록</div>
      <div class = 'expl' id = 'expl'></div>
      <br>
    </article>
    <footer>
      <nav>
        <ul style = 'margin-bottom: 0;'>
          <li id = 'index'><a href = 'index.php'><i class='material-icons'>assignment</i></a></li>
          <li id = 'find' style = 'background-color: orange;'><a href = 'find.php'><i class='material-icons' style = 'color: white;'>pageview</i></a></li>
          <li id = 'mypage'><a href = 'mypage.php'><i class='material-icons'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a href = 'more.php'><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
    <!--mysql & map 연동-->
    <?php
      $conn = mysqli_connect("localhost", "root", "kwondong704","users");
      if(!$conn){
        print "Error - Could not connect to MySQL: ".mysqli_error();
        exit;
      }
      $sql = "SELECT * FROM stores";
      $result = mysqli_query($conn, $sql);
      if($result){
        while($row = mysqli_fetch_assoc($result)){
          $store_name[] = $row['store'];
          $store_tag[] = $row['tag'];
          $lat[] = $row['lat'];
          $lng[] = $row['lng'];
          $txt[] = $row['txt'];
          $store_N[] = $row['store_N'];
          $review[] = $row['reviews'];
          $ppl[] = $row['ppl'];
        }
        mysqli_close($conn);
      }

      else{
        mysqli_close($conn);
      }

    ?>
    <script type = "text/javascript">
    	var selected_tags = ["0","0","0","0","0","0","0","0","0","0","0"];
      var selected = [];
    	function func1(args)
    	{
        if(args != '0' && args != '-1' && args != '-2' && args != '-3' && args != '-4'){
      		var x = document.getElementById("tag"+args);
      		if (selected_tags[parseInt(args)-1] == "tag")
      		{
      			x.style.backgroundColor = "white";
      			x.style.color = "orange";
            var x4 = document.getElementById('dist-nav').children[0].children[0].style;
            var x3 = document.getElementById('dist-nav').children[0].children[1].style;
            var x2 = document.getElementById('dist-nav').children[0].children[2].style;
            var x1 = document.getElementById('dist-nav').children[0].children[3].style;
            x1.color = 'orange';
            x1.backgroundColor = 'white';
            x2.color = 'orange';
            x2.backgroundColor = 'white';
            x3.color = 'orange';
            x3.backgroundColor = 'white';
            x4.color = 'orange';
            x4.backgroundColor = 'white';
      			selected_tags[parseInt(args)-1] = "0";
      		}
      		else
      		{
      			selected_tags[parseInt(args)-1] = "tag";
      			x.style.backgroundColor = "orange";
      			x.style.color = "white";
            var x4 = document.getElementById('dist-nav').children[0].children[0].style;
            var x3 = document.getElementById('dist-nav').children[0].children[1].style;
            var x2 = document.getElementById('dist-nav').children[0].children[2].style;
            var x1 = document.getElementById('dist-nav').children[0].children[3].style;
            x1.color = 'white';
            x1.backgroundColor = 'orange';
            x2.color = 'orange';
            x2.backgroundColor = 'white';
            x3.color = 'orange';
            x3.backgroundColor = 'white';
            x4.color = 'orange';
            x4.backgroundColor = 'white';
      		}

          var select_all = [];
          for(i in selected_tags){
            if(selected_tags[i] == "tag"){
              select_all.push(i);
            }
          }

          start(select_all, args);
        }
        else if(args == '0'){
          var x = document.getElementById("search");
          var search = x.value;
          var store_name = <?=json_encode($store_name)?>;
          var select_all = [];

          for(var i in store_name){
            if(store_name[i].indexOf(search) != -1){
              select_all.push(i);
            }
          }
          var x4 = document.getElementById('dist-nav').children[0].children[0].style;
          var x3 = document.getElementById('dist-nav').children[0].children[1].style;
          var x2 = document.getElementById('dist-nav').children[0].children[2].style;
          var x1 = document.getElementById('dist-nav').children[0].children[3].style;
          x1.color = 'white';
          x1.backgroundColor = 'orange';
          x2.color = 'orange';
          x2.backgroundColor = 'white';
          x3.color = 'orange';
          x3.backgroundColor = 'white';
          x4.color = 'orange';
          x4.backgroundColor = 'white';
          start(select_all, args);
        }
        else{
          var store_name = <?=json_encode($store_name)?>;
          var lat = <?=json_encode($lat)?>;
          var lng = <?=json_encode($lng)?>;
          var ppl_all = <?=json_encode($ppl)?>;
          var select_all = [];
          if(selected.length == 0){
            alert("검색과 태그로 필터링된 가게가 없습니다!");
            return;
          }
          for(var i in selected){
            var index = selected[i];
            var ppl = parseInt(ppl_all[index]);
            if(args == '-1'){
              select_all.push(index);
              var x4 = document.getElementById('dist-nav').children[0].children[0].style;
              var x3 = document.getElementById('dist-nav').children[0].children[1].style;
              var x2 = document.getElementById('dist-nav').children[0].children[2].style;
              var x1 = document.getElementById('dist-nav').children[0].children[3].style;
              x1.color = 'white';
              x1.backgroundColor = 'orange';
              x2.color = 'orange';
              x2.backgroundColor = 'white';
              x3.color = 'orange';
              x3.backgroundColor = 'white';
              x4.color = 'orange';
              x4.backgroundColor = 'white';
            }
            else if(args == '-2'){
              if(30 < ppl && ppl <= 100)
                select_all.push(index);
              var x4 = document.getElementById('dist-nav').children[0].children[0].style;
              var x3 = document.getElementById('dist-nav').children[0].children[1].style;
              var x2 = document.getElementById('dist-nav').children[0].children[2].style;
              var x1 = document.getElementById('dist-nav').children[0].children[3].style;
              x1.color = 'orange';
              x1.backgroundColor = 'white';
              x2.color = 'white';
              x2.backgroundColor = 'orange';
              x3.color = 'orange';
              x3.backgroundColor = 'white';
              x4.color = 'orange';
              x4.backgroundColor = 'white';
            }
            else if(args == '-3'){
              if(100 < ppl && ppl <= 200)
                select_all.push(index);
              var x4 = document.getElementById('dist-nav').children[0].children[0].style;
              var x3 = document.getElementById('dist-nav').children[0].children[1].style;
              var x2 = document.getElementById('dist-nav').children[0].children[2].style;
              var x1 = document.getElementById('dist-nav').children[0].children[3].style;
              x1.color = 'orange';
              x1.backgroundColor = 'white';
              x2.color = 'orange';
              x2.backgroundColor = 'white';
              x3.color = 'white';
              x3.backgroundColor = 'orange';
              x4.color = 'orange';
              x4.backgroundColor = 'white';
            }
            else if(args == '-4'){
              if(200 < ppl)
                select_all.push(index);
              var x4 = document.getElementById('dist-nav').children[0].children[0].style;
              var x3 = document.getElementById('dist-nav').children[0].children[1].style;
              var x2 = document.getElementById('dist-nav').children[0].children[2].style;
              var x1 = document.getElementById('dist-nav').children[0].children[3].style;
              x1.color = 'orange';
              x1.backgroundColor = 'white';
              x2.color = 'orange';
              x2.backgroundColor = 'white';
              x3.color = 'orange';
              x3.backgroundColor = 'white';
              x4.color = 'white';
              x4.backgroundColor = 'orange';
            }
          }
          console.log(select_all);
          start(select_all, args);
        }
    	}
      function start(args1, args2)
      {
        init(args1, args2);
      }
      //map init setting div:"maps"
      //php->js ------------------------------------------------------------------------------------------------------------
      var lat = <?=json_encode($lat)?>;
      var lng = <?=json_encode($lng)?>;
      var s_name = <?=json_encode($store_name)?>;
      var s_tag = <?=json_encode($store_tag)?>;
      var txt = <?=json_encode($txt)?>;
      var reviews = <?=json_encode($review)?>;
      function init(args1, args2)
      {
        var map = new naver.maps.Map('map', {
          center: new naver.maps.LatLng(37.5575031, 126.9368837),
          zoom: 11,
          zoomControl: true,
          minZoom:11
        });
        if(args2 != '0' && args2!= '-1' && args2!= '-2' && args2!= '-3' && args2!= '-4'){//ifstart~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~``
          if(args1 == undefined) return;
          //marker -------------------------------------------------------------------------------------------------------------
          var marker = [];
          for(var i = 0; i < lat.length; i++){
            if(args1.indexOf(parseInt(s_tag[i])-1+"") != -1){
              marker[i] = new naver.maps.Marker({
                position: new naver.maps.LatLng(lat[i], lng[i]),
                map: map
              });
            }
          }

          //Explain-----------------------------------------------------------------------------------------------------------------
          var expl = [];
          selected = [];

          for(var i = 0; i < lat.length; i++){
            var x;
            if('<?=$isuser?>'=='t')  x = i;
            else x = "x";
            if(args1.indexOf(parseInt(s_tag[i])-1+"") != -1){
              expl[i] = [
                    '<div class="expl-each">',
                    ' <h1>'+s_name[i]+'</h1>',
                    '<br>',
                    ' <h2>'+txt[i].slice(0,10)+'...</h2>',
                    ' <div class="button"><ul><li><a href = "resv.php?i='+x+'">바로예약</a></li><li><a href = "storemore.php?i='+i+'" style "color: orange;">상세보기</a></li><li>리뷰('+reviews[i]+')</li></ul></div>',
                    '</div>'
              ].join('');
              selected.push(i);
            }
            else{
              expl[i] = '0';
            }

          }
          var expl_s = "";
          for(var i = 0; i < lat.length; i++){
            if(expl[i] != '0'){
              expl_s += expl[i];
            }
          }
          if(expl_s == ""){
            expl_s = "<div class = 'more' style = 'border: none;'>검색해주세요!</div>"
          }

          document.getElementById('expl').innerHTML = expl_s;

          var explain = [];
          for(var i = 0; i < lat.length; i++){
            if(args1.indexOf(parseInt(s_tag[i])-1+"") != -1){
              var tagname = document.getElementsByClassName("tag")[parseInt(s_tag[i])-1].innerText;
              explain[i] = [
                    '<div class="iw_inner">',
                    ' <h3>'+s_name[i]+'</h3>',
                    ' <h3>'+tagname+'</h3>',
                    '</div>'
                  ].join('');
              setName(explain[i], marker[i]);
            }
          }
        }//ifend~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        else{
          if(args1 == undefined) return;
          //marker -------------------------------------------------------------------------------------------------------------
          var marker = [];
          for(var i = 0; i < lat.length; i++){
            if(args1.indexOf(i) != -1){
              marker[i] = new naver.maps.Marker({
                position: new naver.maps.LatLng(lat[i], lng[i]),
                map: map
              });
            }
          }
          //Explain-----------------------------------------------------------------------------------------------------------------
          var expl = [];
          if(args2 == '0') selected = [];
          for(var i = 0; i < lat.length; i++){
            var x;
            if('<?=$isuser?>'=='t')  x = i;
            else x = "x";
            if(args1.indexOf(i) != -1){
              expl[i] = [
                    '<div class="expl-each">',
                    ' <h1>'+s_name[i]+'</h1>',
                    '<br>',
                    ' <h2>'+txt[i].slice(0,10)+'...</h2>',
                    ' <div class="button"><ul><li><a href = "resv.php?i='+x+'">바로예약</a></li><li><a href = "storemore.php?i='+i+'" style "color: orange;">상세보기</a></li></ul></div>',
                    '</div>'
              ].join('');
              if(args2 == '0') selected.push(i);
            }
            else{
              expl[i] = '0';
            }

          }
          var expl_s = "";
          for(var i = 0; i < lat.length; i++){
            if(expl[i] != '0'){
              expl_s += expl[i];
            }
          }
          if(expl_s == ""){
            expl_s = "<div class = 'more' style = 'border: none;'>검색해주세요!</div>"
          }

          document.getElementById('expl').innerHTML = expl_s;

          var explain = [];
          for(var i = 0; i < lat.length; i++){
            if(args1.indexOf(i) != -1){
              explain[i] = [
                    '<div class="iw_inner">',
                    ' <h3>'+s_name[i]+'</h3>',
                    '</div>'
                  ].join('');
              setName(explain[i], marker[i]);
            }
          }
        }
      //-----------------------------------------------------------------------------------------------------------------
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
      //-----------------------------------------------------------------------------------------------------------------

      }
      addEventListener("load", start(), false);
    </script>

  </body>

</html>

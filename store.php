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
    <script type="text/javascript" src="reg_store.js"></script>

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
      .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: orange;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
      }
      .prev{
        left: 0;
      }
      .next {
        right: 0;
        border-radius: 3px 0 0 3px;
      }
      .prev:hover, .next:hover {
        background-color: orange;
        color: white;
      }
      a.prev, a.next, a.reg{
        text-decoration: none;
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
      .button {
        background-color: orange;
        border: 2px solid orange;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
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
      <br/><br/>
      <div id = 'login-box'>
        <div class = 'container'>
          <h1><점주님의 가게 등록하기></h1>
          <div id = 'store-reg'>
            <div class = 'step'>
              <br>
              <h1>2. 가게 정보를 알려주세요!</h1>
              <br>
              <p>상호명:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type = 'text' id = 'store' style = 'color: black;' required/></p>
              <p>최대수용인원: <input type = 'number' id = 'ppl' style = 'color: black;' required/>명</p>
              <p>가게정보: <textarea style = 'color: black;' rows = '10' cols = '25' id = 'txt' value = '' placeholder="영업시간, 예약조건 등 가게 운영에 필요한 조건들을 자유롭게 적어주세요 그대로 가게 공지에서 확인할 수 있습니다."></textarea></p>
            </div>
            <div class = 'step'>
              <br>
              <h1>3. 가게 태그를 설정해주세요!</h1>
              <h1>(가장 가게를 잘 대표할 수 있는 음식을 하나 선정해주세요!)</h1>
              <br>
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
        			  <div class = "tag" id = "tag1" onclick ="func1('11')">그 외</div>
                <input type = "hidden" id = "tag" value = ""/>
                <h1 id = "describe"></h1>
              </div>
            </div>
            <div class = 'step'>
              <br>
              <h1>4. 가게 등록을 완료합니다!</h1>
              <br><br>
              <div class="button" style = 'margin-left: 20%' onclick = 'goREG()'>등록</div>
              <br>
            </div>
            <div class = 'step'>
              <br>
              <h1>1. 가게 위치를 우선 지도에 찍어주세요!</h1>
              <h1>(현재 신촌지역에 한해 운영하고 있습니다)</h1>
              <div id ="map" style = "width:100%;height:300px;"></div>
              <div style="position:absolute;z-index:10000;background-color:#fff;border:solid 1px #333;padding:10px;display:none;"></div>
              <input type="hidden" id ="lat" value=""/>
              <input type="hidden" id ="lng" value=""/>
              <br>
            </div>
            <a class="prev" onclick="plusStep(-1)">&#10094;</a>
            <a class="next" onclick="plusStep(1)">&#10095;</a>
            <div id="hidden_form_container" style="display:none;"></div>
          </div>
        </div>
      </div>
    </article>
    <footer>
      <nav>
        <ul style = 'height: 56px;'>
          <li id = 'find'><a href = 'find.php'><i class='material-icons'>pageview</i></a></li>
          <li id = 'review'><a href = 'review.php'><i class='material-icons'>assignment</i></a></li>
          <li id = 'mypage' style = 'background-color: orange;'><a href = 'mypage.php'><i class='material-icons' style = 'color: white;'>info</i></a></li>
          <li id = 'more' style = 'border-right: 0;'><a href = 'more.php'><i class='material-icons'>more</i></a></li>
        </ul>
      </nav>
    </footer>
    <script>
      var stepIndex = 0;
      showStep(stepIndex);

      function plusStep(n) {
        showStep(stepIndex += n);
      }
      function showStep(n) {
        var i;
        var step = document.getElementsByClassName("step");
        if (n > step.length) {stepIndex = 1}
        if (n < 1) {stepIndex = step.length}
        for (i = 0; i < step.length; i++) {
            step[i].style.display = "none";
        }
        step[stepIndex-1].style.display = "block";
      }

    </script>
    <script>
      var selected_tags = ["0","0","0","0","0","0","0","0","0","0","0","0","0"];
      function func1(args)
      {
        var x = document.getElementById("tag"+args);
        if (selected_tags[parseInt(args)-1] == "tag")
        {
          x.style.backgroundColor = "white";
          x.style.color = "orange";
          selected_tags[parseInt(args)-1] = "0";
        }
        else
        {
          for(var i in selected_tags){
            if(selected_tags[i] != "0"){
              var i_p = parseInt(i) + 1;
              var y = document.getElementById("tag"+i_p+"");
              y.style.backgroundColor = "white";
              y.style.color = "orange";
              selected_tags[i] = "0";
            }
          }
          selected_tags[parseInt(args)-1] = "tag";
          x.style.backgroundColor = "orange";
          x.style.color = "white";
        }
        for(var i in selected_tags){
          if(selected_tags[i] != "0"){
            var i_p = parseInt(i) + 1;
            var hid = document.getElementById("tag");
            hid.value = i_p;
            var desc = document.getElementById("describe").innerText;
            if(i_p == 1)
              desc = "삼겹살, 곱창, 소고기 등 구워먹는 요리가 대표 메뉴이신가요?";
            else if(i_p == 2)
              desc = "구운 치킨, 튀긴 치킨 등의 요리가 주 메뉴시군요!";
            else if(i_p == 3)
              desc = "막걸리와 어울리는 음식을 팔고 계시는 군요!";
            else if(i_p == 4)
              desc = "양주를 많이 좋아하시는 가봐요! 칵테일 인가요?";
            else if(i_p == 5)
              desc = "가게에 수입맥주가 많나봐요! 혹시 포차식은 아닌가요?";
            else if(i_p == 6)
              desc = "위에 요리 중 4개 이상 팔고 계신가요? 그럼 '포차식'태그는 어떠신지요?!";
            else if(i_p == 7)
              desc = "중국음식을 파시는 가봐요!";
            else if(i_p == 8)
              desc = "꼬치구이.. 오코노미야끼.. 맛있겠어요!";
            else if(i_p == 9)
              desc = "김치찌개? 오뎅탕? 짬뽕? 다 좋아요!";
            else if(i_p == 10)
              desc = "오늘은 회가 땡기는 날이군요!";
            else {
              desc = "위의 메뉴가 모두 해당이 안되시나요?";
            }
          }
        }
      }
    </script>
    <script>
      function goREG(){
        var lat = document.getElementById("lat").value;
        var lng = document.getElementById("lng").value;
        var store = document.getElementById("store").value;
        var ppl = document.getElementById("ppl").value;
        var txt = document.getElementById("txt").value;
        var tag = document.getElementById('tag').value;
        if(lat == "" || lng == "" || store == "" || ppl == "" || txt == "" || tag == ""){
          window.alert('제출하지않은 양식이 있습니다!');
          return;
        }
        /*
        var json_d = {"lat":lat, "lng":lng, "store":store, "ppl":ppl, "txt":txt, "tag":tag};

        var json_s = JSON.stringify(json_d);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "storeOK.php");
        xhr.onreadystatechange = function(){
          if(this.readyState == 4 && this.readyState == 200){
            window.location('storeOK.php');
          }
        }
        xhr.send("data="+json_s);
        */
        var theForm, newInput1, newInput2, newInput3, newInput4, newInput5, newInput6;
        // Start by creating a <form>
        theForm = document.createElement('form');
        theForm.action = 'storeOK.php';
        theForm.method = 'post';
        // Next create the <input>s in the form and give them names and values
        newInput1 = document.createElement('input');
        newInput1.type = 'hidden';
        newInput1.name = 'lat';
        newInput1.value = lat;
        newInput2 = document.createElement('input');
        newInput2.type = 'hidden';
        newInput2.name = 'lng';
        newInput2.value = lng;
        newInput3 = document.createElement('input');
        newInput3.type = 'hidden';
        newInput3.name = 'store';
        newInput3.value = store;
        newInput4 = document.createElement('input');
        newInput4.type = 'hidden';
        newInput4.name = 'ppl';
        newInput4.value = ppl;
        newInput5 = document.createElement('input');
        newInput5.type = 'hidden';
        newInput5.name = 'txt';
        newInput5.value = txt;
        newInput6 = document.createElement('input');
        newInput6.type = 'hidden';
        newInput6.name = 'tag';
        newInput6.value = tag;
        // Now put everything together...
        theForm.appendChild(newInput1);
        theForm.appendChild(newInput2);
        theForm.appendChild(newInput3);
        theForm.appendChild(newInput4);
        theForm.appendChild(newInput5);
        theForm.appendChild(newInput6);
        // ...and it to the DOM...
        document.getElementById('hidden_form_container').appendChild(theForm);
        // ...and submit it
        theForm.submit();

      }
    </script>
  </body>

</html>

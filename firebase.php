<!DOCTYPE html>
<html>
<body>
</body>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBwh7TxN47Qp9qPtJr6XgECAzC-aoxe0kg",
    authDomain: "internet-teamproject-1.firebaseapp.com",
    databaseURL: "https://internet-teamproject-1.firebaseio.com",
    projectId: "internet-teamproject-1",
    storageBucket: "",
    messagingSenderId: "910402825946"
  };
  firebase.initializeApp(config);
  function login(){
	function newLoginHappened(user){
		if (user){
			app(user);
			}
		else{
			var provider = new firebase.auth.GoogleAuthProvider();
			firebase.auth().signInWithRedirect(provider);
		}
	}
	firebase.auth().onAuthStateChanged(newLoginHappened);
	}
	function app(user)
	{
    var name = user.displayName;
		var email = user.email;
		var form = document.createElement("form");
		form.setAttribute("method", "Post");
		form.setAttribute("action", "login_google.php");
		var hiddenField = document.createElement("input");
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", "name");
		hiddenField.setAttribute("value", name);
		form.appendChild(hiddenField);
		var hiddenField1 = document.createElement("input");
		hiddenField1.setAttribute("type", "hidden");
		hiddenField1.setAttribute("name", "email");
		hiddenField1.setAttribute("value", email);
		form.appendChild(hiddenField1);
		document.body.appendChild(form);
		form.submit();
	}
	window.onload = login;
</script>
</html>

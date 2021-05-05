<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" type="text/css" href = "login.css">
</head>
<body>
	<!-- Form which holds both the register_info and login_info -->
	<div class = "FormHolder">
			<section class = "signup-form">
				<div class = "signupForm">
						<div class = "button-box">
							<div id = "btn"> 
							</div>
							<button type = "button" class = "toggle-button" onclick = "register()"> Register
							</button>
							<button type = "button" class = "toggle-button" onclick = "login()"> Log in 
							</button>
						</div>
						<form class = "input-form" action ="interface.php" id = "register" method=POST>
							<input type ="varchar(16)" class = "input-field" name="name" placeholder="Username" required>
							<input type ="password" class = "input-field" name="pass" placeholder="Enter Password" required>
							<input type ="varchar(2)" class = "input-field" name="state" placeholder="State" required>
							<input type ="varchar(64)" class = "input-field" name="city" placeholder="City" required>
							<input type ="varchar(64)" class = "input-field" name="street" placeholder="Street" required>
							<input type ="varchar(16)" class = "input-field" name="payment" placeholder="Payment method" required>
							<button type="submit" class = "btn-btn-primary" name="submit">
							Sign up
						  </button>
						</form>
						<div class = "loginForm">
							<form action= "interface.php" class = "input-form" id = "login" method=POST>
								<input type ="varchar(16)" class = "input-field" name="login_name" placeholder="Username" required>
								<input type="varchar(64)" class = "input-field" name="login_pass" placeholder="Password" required>
								<button type="submit" class = "btn-btn-primary" name="login_submit">
								Login
								</button>
							</form>
						</div>
				</div> 
			</section>
	</div>

<script>
	var register_id = document.getElementById("register");
	var login_id = document.getElementById("login");
	var button_id = document.getElementById("btn");
	var login_form = document.getElementById("login_form");
//shifts the login form to the left so that it is visible to the user
	function login(){
		register_id.style.left = "-400px";
		login_id.style.left = "50px";
		button_id.style.right = "0px";
	}
//shifts the register form back into view for the user 
	function register(){
		register_id.style.left = "50px";
		login_id.style.left = "450px";
		button_id.style.right = "100px";
	}
</script>

<!-- <div class = "loginForm">
	<form action= "interface.php" method=POST>
	  <input type ="varchar(16)" name="login_name" placeholder="UserName">
	  <br>
	  <input type="varchar(64)" name="login_pass" placeholder="Password">
	  <button type="submit" class = "btn-btn-primary" name="login_submit">
		Login
	  </button>
	</form>
</div> -->
</body>
</html>

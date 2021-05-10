<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" type="text/css" href = "css\background.css">
	<link rel = "stylesheet" type="text/css" href = "css/login.css">
</head>
<body>
	<div class = "header">  
		<div class = "inner_header">
			<div class = "logo_container">
				<img src = "images/logo.png" class = "logo" id = "logo_img"> <!-- clicking on this does nothing currently. hover shows cursor -->
			</div>
		</div>
		<div class = "FormHolder" id = "loginForm">
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
							<!-- <img src = "/images/Sample_User_Icon.png"> -->
							<!--<label for = "name"> <b> Username - </b> </label> -->
							<input type ="varchar(16)" class = "input-field" name="name" placeholder="Username" required>
							<input type ="password" class = "input-field" name="pass" placeholder="Enter Password" pattern = ".{5,64}" required>
							<!-- <input type ="varchar(2)" class = "input-field" name="state" placeholder="State" required> -->
							<select name = "state" class = "states" required>
								<option value "" disabled selected> Select State </option>
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District Of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
							<input type ="varchar(64)" class = "input-field" name="city" placeholder="City" required>
							<input type ="varchar(64)" class = "input-field" name="street" placeholder="Street" required>
							<!-- <input type ="varchar(16)" class = "input-field" name="payment" placeholder="Payment method" required> -->
							<select name = "payment" class = "payment-method" required>
								<option value "" disabled selected> Select Credit Card </option>
								<option value="MasterCard">MasterCard</option>
								<option value="Visa">Visa</option>
								<option value="American Express">American Express</option>
								<option value="Discover">Discover</option>
							</select>
							<button type="submit" class = "btn-btn-primary" name="submit">
							Sign up
						  </button>
						</form>
						<div class = "loginForm">
							<form action= "interface.php" class = "input-form" id = "login" method=POST>
								<input type ="varchar(16)" class = "input-field" name="login_name" placeholder="Username" required>
								<input type="password" class = "input-field" name="login_pass" placeholder="Password" required>
								<button type="submit" class = "btn-btn-primary" name="login_submit">
								Login
								</button>
							</form>
						</div>
				</div> 
		</div>
	</div>
	<script> /* Shifts the forms in and out of vision of the user */
		var register_id = document.getElementById("register");
		var login_id = document.getElementById("login");
		var button_id = document.getElementById("btn");
		var login_form = document.getElementById("login_form");
		//set max length of the password to 64 characters
		document.getElementById("passwordfield").maxLength = "64";
		function login(){
			register_id.style.left = "-400px";
			login_id.style.left = "50px";
			button_id.style.right = "0px";
		}
		function register(){
			register_id.style.left = "50px";
			login_id.style.left = "450px";
			button_id.style.right = "100px";
		}
	</script>
</body>
</html>

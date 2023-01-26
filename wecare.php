<!DOCTYPE html>
<html>
<head>
	<title>SignUp and Login</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container" id="container">
<div class="form-container sign-up-container">

<form action="/signinsucess.html">
	<h1>Create Account</h1>
	<div class="social-container">
		<a href="#" class="social"><i class="fa fa-facebook"></i></a>
		<a href="#" class="social"><i class="fa fa-google"></i></a>
		<a href="#" class="social"><i class="fa fa-linkedin"></i></a>
	</div>
	<span>or use your email for registration</span>
	<input type="text" name="nameRegister" placeholder="Name" required> 
	<input type="email" name="emailRegister" placeholder="Email" required>
	<input type="password" name="passwordRegister" placeholder="Password" required>
	<input type="submit" value="register" name="signup">
</form>
</div>
<div class="form-container sign-in-container">
	<form action="/index.html" required>
		<h1>Sign In</h1>
		<div class="social-container">
		<a href="#" class="social"><i class="fa fa-facebook"></i></a>
		<a href="#" class="social"><i class="fa fa-google"></i></a>
		<a href="#" class="social"><i class="fa fa-linkedin"></i></a>
	</div>
	<span>or use your account</span>
	<input type="email" name="emailLogin" placeholder="Email" required>
	<input type="password" name="passwordLogin" placeholder="Password" required>
	<a href="#">Forgot Your Password</a>

	<a href="index.html"button>Sign In</button>
	</form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			
			<h1>Welcome Back Fur Parents!</h1>
			<p>To keep connected with us please login with your personal info</p>
			<button class="ghost" id="signIn">Sign In</button>
		</div>
		<div class="overlay-panel overlay-right">
			<h1>Hello Fur Parents!!</h1>
			<p>Enter your details and adopt a pet in our shelter</p>
			<button class="ghost" id="signUp">Sign Up</button>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
</script>
</body>
</html>


<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

if(isset($_POST['signup'])) {
if(empty(trim($_POST['']))) {
echo '<script type="text/javascript"> alert("Input fields must have values (email, password)"); </script>';

} else {
$name = mysqli_real_escape_string($conn, $_POST['nameRegister']);
$email = mysqli_real_escape_string($conn, $_POST['emailRegister']);
$password = mysqli_real_escape_string($conn, $_POST['passwordRegister']);

//hash password
$encrypt_password = password_hash($password, PASSWORD_DEFAULT);

$conn->query("INSERT INTO wcsreglogin (name, email, password) VALUES ('$name', '$email', '$encrypt_password')");

if($conn->affected_rows != 1) {
		echo '<script type="text/javascript"> alert("something went wrong"); </script>';
	} else {
		echo '<script type="text/javascript"> alert("sign up successful"); </script>';
	}
}

}


?>
<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Bienvenidos a Artesanos.com</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php  

	if(isset($_POST['register_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
	}


	?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
				<h1>Artesanos.com</h1>
				Registrarse o Iniciar Sesion!
			</div>
			<br>
			<div id="first">

				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Contraseña">
					<br>
					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>
					<input type="submit" name="login_button" value="Logearse">
					<br>
					<a href="#" id="signup" class="signup">Usuario Nuevo? Registrarse!</a>

				</form>

			</div>

			<div id="second">

				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" placeholder="Nombres" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Tu nombre debe tener entre 2 y 25 caracteres<br>", $error_array)) echo "Tu nombre debe tener entre 2 y 25 caracteres<br>"; ?>
					
					


					<input type="text" name="reg_lname" placeholder="Apellido" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Tu apellido debe tener entre 2 y 25 caracteres<br>", $error_array)) echo "Tu apellido debe tener entre 2 y 25 caracteres<br>"; ?>

					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>

					<input type="email" name="reg_email2" placeholder="Confirmar Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Email en uso<br>", $error_array)) echo "Email en uso<br>"; 
					else if(in_array("Formato invalido<br>", $error_array)) echo "Formato invalido<br>";
					else if(in_array("Emails no coinciden<br>", $error_array)) echo "Emails no coinciden<br>"; ?>


					<input type="password" name="reg_password" placeholder="Contraseña" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirmar Contraseña" required>
					<br>
					<?php if(in_array("Contraseñas no coinciden<br>", $error_array)) echo "Contraseñas no coinciden<br>"; 
					else if(in_array("Su contraseña puede contener caracteres o numeros<br>", $error_array)) echo "Su contraseña puede contener caracteres o numeros<br>";
					else if(in_array("Su contraseña debe contener entre 5 y 30 caracteres<br>", $error_array)) echo "Su contraseña debe contener entre 5 y 30 caracteres<br>"; ?>


					<input type="submit" name="register_button" value="Register">
					<br>

					<?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
					<a href="#" id="signin" class="signin">Tiene cuenta? Logeate aqui!</a>
				</form>
			</div>

		</div>

	</div>


</body>
</html>
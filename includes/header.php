<?php  
// Iniciar sesión si no está iniciada
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Conexión a la base de datos
require 'config/config.php';

// Clases necesarias
require_once("includes/classes/User.php");
require_once("includes/classes/Post.php");
require_once("includes/classes/Message.php");
require_once("includes/classes/Notification.php");


// Validar si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit();
}

$userLoggedIn = $_SESSION['username'];
$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
$user = mysqli_fetch_array($user_details_query);
$user_obj = new User($con, $userLoggedIn);
?>

<html>
<head>
	<title>Bienvenidos a Artesanos.com</title>

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<body>

	<div class="top_bar"> 
		<div class="logo">
			<a href="index.php">Artesanos.com</a>
		</div>

		<div class="search">
			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Buscar..." autocomplete="off" id="search_text_input">
				<div class="button_holder">
					<img src="assets/images/icons/magnifying_glass.png">
				</div>
			</form>
			<div class="search_results"></div>
			<div class="search_results_footer_empty"></div>
		</div>

		<nav>
			<?php
				$messages = new Message($con, $userLoggedIn);
				$num_messages = $messages->getUnreadNumber();

				$notifications = new Notification($con, $userLoggedIn);
				$num_notifications = $notifications->getUnreadNumber();

				$user_obj = new User($con, $userLoggedIn);
				$num_requests = $user_obj->getNumberOfFriendRequests();
			?>

			<a href="profile.php?profile_username=<?php echo $userLoggedIn; ?>">
				<?php echo $user['first_name']; ?>
			</a>
			<a href="index.php"><i class="fa fa-home fa-lg"></i></a>
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
				<i class="fa fa-envelope fa-lg"></i>
				<?php if($num_messages > 0) echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>'; ?>
			</a>
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
				<i class="fa fa-bell fa-lg"></i>
				<?php if($num_notifications > 0) echo '<span class="notification_badge" id="unread_notification">' . $num_notifications . '</span>'; ?>
			</a>
			<a href="requests.php">
				<i class="fa fa-users fa-lg"></i>
				<?php if($num_requests > 0) echo '<span class="notification_badge" id="unread_requests">' . $num_requests . '</span>'; ?>
			</a>
			<a href="settings.php"><i class="fa fa-cog fa-lg"></i></a>
			<a href="includes/handlers/logout.php"><i class="fa fa-sign-out fa-lg"></i></a>
		</nav>

		<div class="dropdown_data_window" style="height:0px; border:none;"></div>
		<input type="hidden" id="dropdown_data_type" value="">
	</div>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';
	$(document).ready(function() {
		$('.dropdown_data_window').scroll(function() {
			var inner_height = $('.dropdown_data_window').innerHeight();
			var scroll_top = $('.dropdown_data_window').scrollTop();
			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

			if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {
				var pageName;
				var type = $('#dropdown_data_type').val();

				if(type == 'notification')
					pageName = "ajax_load_notifications.php";
				else if(type == 'message')
					pageName = "ajax_load_messages.php";

				$.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache: false,
					success: function(response) {
						$('.dropdown_data_window').find('.nextPageDropdownData').remove();
						$('.dropdown_data_window').find('.noMoreDropdownData').remove();
						$('.dropdown_data_window').append(response);
					}
				});
			}
			return false;
		});
	});
	</script>

	<div class="wrapper">

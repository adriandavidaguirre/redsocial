<?php
class User {
	private $user;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;

		// Validar existencia del usuario
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
		if($user_details_query && mysqli_num_rows($user_details_query) > 0) {
			$this->user = mysqli_fetch_array($user_details_query);
		} else {
			$this->user = null;
		}
	}

	private function safeAccess($key) {
		return $this->user && isset($this->user[$key]) ? $this->user[$key] : null;
	}

	public function getUsername() {
		return $this->safeAccess('username');
	}

	public function getNumberOfFriendRequests() {
		$username = $this->getUsername();
		if (!$username) return 0;
		$query = mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to='$username'");
		return mysqli_num_rows($query);
	}

	public function getNumPosts() {
	$username = $this->getUsername();
	if (!$username) return 0;

	$query = mysqli_query($this->con, "SELECT COUNT(*) as total FROM posts WHERE added_by='$username' AND deleted='no'");
	$row = mysqli_fetch_array($query);
	return $row['total'] ?? 0;
}

	public function getFirstAndLastName() {
		$username = $this->getUsername();
		if (!$username) return '';
		$query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['first_name'] . " " . $row['last_name'];
	}

	public function getProfilePic() {
		$username = $this->getUsername();
		if (!$username) return '';
		$query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['profile_pic'];
	}

	public function getFriendArray() {
		return $this->safeAccess('friend_array');
	}

	public function isClosed() {
		$username = $this->getUsername();
		if (!$username) return true;
		$query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['user_closed'] === 'yes';
	}

	public function isFriend($username_to_check) {
		if (!$this->user) return false;
		$usernameComma = "," . $username_to_check . ",";
		return (strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username']);
	}

	public function didReceiveRequest($user_from) {
		$user_to = $this->getUsername();
		if (!$user_to) return false;
		$check_request_query = mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
		return mysqli_num_rows($check_request_query) > 0;
	}

	public function didSendRequest($user_to) {
		$user_from = $this->getUsername();
		if (!$user_from) return false;
		$check_request_query = mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
		return mysqli_num_rows($check_request_query) > 0;
	}

	public function removeFriend($user_to_remove) {
		$logged_in_user = $this->getUsername();
		if (!$logged_in_user) return;
		$query = mysqli_query($this->con, "SELECT friend_array FROM users WHERE username='$user_to_remove'");
		$row = mysqli_fetch_array($query);
		$friend_array_username = $row['friend_array'];

		$new_friend_array = str_replace($user_to_remove . ",", "", $this->user['friend_array']);
		mysqli_query($this->con, "UPDATE users SET friend_array='$new_friend_array' WHERE username='$logged_in_user'");

		$new_friend_array = str_replace($logged_in_user . ",", "", $friend_array_username);
		mysqli_query($this->con, "UPDATE users SET friend_array='$new_friend_array' WHERE username='$user_to_remove'");
	}

	public function sendRequest($user_to) {
		$user_from = $this->getUsername();
		if (!$user_from) return;
		mysqli_query($this->con, "INSERT INTO friend_requests VALUES('', '$user_to', '$user_from')");
	}

	public function getMutualFriends($user_to_check) {
		$mutualFriends = 0;
		$user_array = $this->getFriendArray();
		if (!$user_array) return 0;
		$user_array_explode = explode(",", $user_array);

		$query = mysqli_query($this->con, "SELECT friend_array FROM users WHERE username='$user_to_check'");
		$row = mysqli_fetch_array($query);
		$user_to_check_array = $row['friend_array'];
		$user_to_check_array_explode = explode(",", $user_to_check_array);

		foreach($user_array_explode as $i) {
			foreach($user_to_check_array_explode as $j) {
				if($i === $j && $i != "") {
					$mutualFriends++;
				}
			}
		}
		return $mutualFriends;
	}
}
?>

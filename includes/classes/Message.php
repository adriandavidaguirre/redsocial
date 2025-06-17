<?php
if (!class_exists('Message')) {
    class Message {
        private $user_obj;
        private $con;

        public function __construct($con, $user){
            $this->con = $con;
            $this->user_obj = new User($con, $user);
        }

        public function getMostRecentUser() {
            $userLoggedIn = $this->user_obj->getUsername();
            $query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC LIMIT 1");
            if(mysqli_num_rows($query) == 0) return false;
            $row = mysqli_fetch_array($query);
            return ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];
        }

        public function sendMessage($user_to, $body, $date) {
            if($body != "") {
                $userLoggedIn = $this->user_obj->getUsername();
                mysqli_query($this->con, "INSERT INTO messages VALUES('', '$user_to', '$userLoggedIn', '$body', '$date', 'no', 'no', 'no')");
            }
        }

        public function getMessages($otherUser) {
            $userLoggedIn = $this->user_obj->getUsername();
            $data = "";
            mysqli_query($this->con, "UPDATE messages SET opened='yes' WHERE user_to='$userLoggedIn' AND user_from='$otherUser'");
            $get_messages_query = mysqli_query($this->con, "SELECT * FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$otherUser') OR (user_from='$userLoggedIn' AND user_to='$otherUser')");

            while($row = mysqli_fetch_array($get_messages_query)) {
                $div_top = ($row['user_to'] == $userLoggedIn) ? "<div class='message' id='green'>" : "<div class='message' id='blue'>";
                $button = "<span class='deleteButton' onclick='deleteMessage({$row['id']}, this)'>X</span>";
                $data .= $div_top . $button . $row['body'] . "</div><br><br>";
            }
            return $data;
        }

        public function getLatestMessage($userLoggedIn, $user2) {
            $details_array = [];
            $query = mysqli_query($this->con, "SELECT body, user_to, date FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$user2') OR (user_to='$user2' AND user_from='$userLoggedIn') ORDER BY id DESC LIMIT 1");
            $row = mysqli_fetch_array($query);
            $sent_by = ($row['user_to'] == $userLoggedIn) ? "They said: " : "You said: ";

            $start_date = new DateTime($row['date']);
            $end_date = new DateTime(date("Y-m-d H:i:s"));
            $interval = $start_date->diff($end_date);

            if($interval->y >= 1) $time_message = $interval->y . (($interval->y == 1) ? " year ago" : " years ago");
            else if ($interval->m >= 1) {
                $days = ($interval->d == 0) ? " ago" : (($interval->d == 1) ? " day ago" : " days ago");
                $time_message = $interval->m . (($interval->m == 1) ? " month" : " months") . $days;
            }
            else if($interval->d >= 1) $time_message = ($interval->d == 1) ? "Yesterday" : $interval->d . " days ago";
            else if($interval->h >= 1) $time_message = $interval->h . (($interval->h == 1) ? " hour ago" : " hours ago");
            else if($interval->i >= 1) $time_message = $interval->i . (($interval->i == 1) ? " minute ago" : " minutes ago");
            else $time_message = ($interval->s < 30) ? "Just now" : $interval->s . " seconds ago";

            return [$sent_by, $row['body'], $time_message];
        }

        public function getConvos() {
            $userLoggedIn = $this->user_obj->getUsername();
            $return_string = "";
            $convos = [];

            $query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC");

            while($row = mysqli_fetch_array($query)) {
                $user = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];
                if(!in_array($user, $convos)) array_push($convos, $user);
            }

            foreach($convos as $username) {
                $user_found_obj = new User($this->con, $username);
                $latest_message_details = $this->getLatestMessage($userLoggedIn, $username);
                $preview = strlen($latest_message_details[1]) >= 12 ? substr($latest_message_details[1], 0, 12) . "..." : $latest_message_details[1];

                $return_string .= "<a href='messages.php?u=$username'><div class='user_found_messages'>
                    <img src='" . $user_found_obj->getProfilePic() . "' style='border-radius:5px; margin-right:5px;'>
                    " . $user_found_obj->getFirstAndLastName() . "
                    <span class='timestamp_smaller' id='grey'>" . $latest_message_details[2] . "</span>
                    <p id='grey' style='margin:0;'>" . $latest_message_details[0] . $preview . "</p>
                </div></a>";
            }

            return $return_string;
        }

        public function getConvosDropdown($data, $limit) {
            $page = $data['page'];
            $userLoggedIn = $this->user_obj->getUsername();
            $start = ($page == 1) ? 0 : ($page - 1) * $limit;

            $return_string = "";
            $convos = [];
            mysqli_query($this->con, "UPDATE messages SET viewed='yes' WHERE user_to='$userLoggedIn'");
            $query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC");

            while($row = mysqli_fetch_array($query)) {
                $user = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];
                if(!in_array($user, $convos)) array_push($convos, $user);
            }

            $num_iterations = 0;
            $count = 1;

            foreach($convos as $username) {
                if($num_iterations++ < $start) continue;
                if($count > $limit) break;
                $count++;

                $is_unread_query = mysqli_query($this->con, "SELECT opened FROM messages WHERE user_to='$userLoggedIn' AND user_from='$username' ORDER BY id DESC");
                $row = mysqli_fetch_array($is_unread_query);
                $style = ($row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";

                $user_found_obj = new User($this->con, $username);
                $latest_message_details = $this->getLatestMessage($userLoggedIn, $username);
                $preview = strlen($latest_message_details[1]) >= 12 ? substr($latest_message_details[1], 0, 12) . "..." : $latest_message_details[1];

                $return_string .= "<a href='messages.php?u=$username'>
                    <div class='user_found_messages' style='$style'>
                        <img src='" . $user_found_obj->getProfilePic() . "' style='border-radius:5px; margin-right:5px;'>
                        " . $user_found_obj->getFirstAndLastName() . "
                        <span class='timestamp_smaller' id='grey'>" . $latest_message_details[2] . "</span>
                        <p id='grey' style='margin:0;'>" . $latest_message_details[0] . $preview . "</p>
                    </div>
                </a>";
            }

            if($count > $limit) {
                $return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
            } else {
                $return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'><p style='text-align:center;'>No hay mensajes!</p>";
            }

            return $return_string;
        }

        public function getUnreadNumber() {
            $userLoggedIn = $this->user_obj->getUsername();
            $query = mysqli_query($this->con, "SELECT * FROM messages WHERE viewed='no' AND user_to='$userLoggedIn'");
            return mysqli_num_rows($query);
        }
    }
}
?>

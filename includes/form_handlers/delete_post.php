<?php 
require '../../config/config.php';

if(isset($_GET['post_id']) && isset($_POST['result'])) {
    $post_id = $_GET['post_id'];

    if($_POST['result'] == 'true') {
        $query = mysqli_query($con, "UPDATE posts SET deleted='yes' WHERE id='$post_id'");
        mysqli_query($con, "DELETE FROM trends_posts WHERE post_id='$post_id'");


        if($query) {
            echo "Post deleted";
        } else {
            echo "Error deleting post";
        }
    } else {
        echo "Deletion cancelled";
    }
} else {
    echo "Missing data";
}
?>

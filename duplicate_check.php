<?php
include "db.php";

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('이미 사용 중인 User ID입니다.');
            history.back();
          </script>";
} else {
    echo "<script>
            alert('사용 가능한 User ID입니다.');
            history.back();
          </script>";
}
?>
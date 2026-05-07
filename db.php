<?php
$conn = mysqli_connect("localhost", "root", "", "hw_board");

if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}

# echo "DB연결 성공(컴파일용)"
?>
<?php
session_start();
include "db.php";

// 로그인하지 않은 사용자는 로그인 페이지로 이동
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('로그인이 필요합니다.');
            location.href = 'index.php';
          </script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$password = $_POST['password'];
$title = $_POST['title'];
$content = $_POST['content'];

// 빈칸 검사
if ($password == "" || $title == "" || $content == "") {
    echo "<script>
            alert('모든 항목을 입력하세요.');
            history.back();
          </script>";
    exit;
}

// 비밀번호 확인
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user['password'] !== $password) {
    echo "<script>
            alert('비밀번호가 일치하지 않습니다.');
            history.back();
          </script>";
    exit;
}

// 게시글 저장
$sql = "INSERT INTO posts (user_id, title, content)
        VALUES ('$user_id', '$title', '$content')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('게시글이 작성되었습니다.');
            location.href = 'list.php';
          </script>";
} else {
    echo "<script>
            alert('게시글 작성 실패');
            history.back();
          </script>";
}
?>
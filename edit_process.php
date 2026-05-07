<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('로그인이 필요합니다.');
            location.href = 'index.php';
          </script>";
    exit;
}

$post_id = (int)$_POST['post_id'];
$password = $_POST['password'];
$title = $_POST['title'];
$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

if ($password == "" || $title == "" || $content == "") {
    echo "<script>
            alert('모든 항목을 입력하세요.');
            history.back();
          </script>";
    exit;
}

// 게시글 확인
$sql = "SELECT * FROM posts WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('존재하지 않는 게시글입니다.');
            location.href = 'list.php';
          </script>";
    exit;
}

$post = mysqli_fetch_assoc($result);

// 작성자 확인
if ($post['user_id'] !== $user_id) {
    echo "<script>
            alert('본인이 작성한 글만 수정할 수 있습니다.');
            location.href = 'view.php?post_id=$post_id';
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

// 특수문자 처리
$title = mysqli_real_escape_string($conn, $title);
$content = mysqli_real_escape_string($conn, $content);

// 게시글 수정
$sql = "
    UPDATE posts
    SET title = '$title',
        content = '$content'
    WHERE post_id = $post_id
";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('게시글이 수정되었습니다.');
            location.href = 'view.php?post_id=$post_id';
          </script>";
} else {
    echo "<script>
            alert('게시글 수정 실패');
            history.back();
          </script>";
}
?>
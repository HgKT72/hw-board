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

if (!isset($_GET['post_id'])) {
    echo "<script>
            alert('잘못된 접근입니다.');
            location.href = 'list.php';
          </script>";
    exit;
}

$post_id = (int)$_GET['post_id'];
$user_id = $_SESSION['user_id'];

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
            alert('본인이 작성한 글만 삭제할 수 있습니다.');
            location.href = 'view.php?post_id=$post_id';
          </script>";
    exit;
}

// 게시글 삭제
$sql = "DELETE FROM posts WHERE post_id = $post_id";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('게시글이 삭제되었습니다.');
            location.href = 'list.php';
          </script>";
} else {
    echo "<script>
            alert('게시글 삭제 실패');
            location.href = 'view.php?post_id=$post_id';
          </script>";
}
?>
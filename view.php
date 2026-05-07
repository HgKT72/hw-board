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

// post_id가 없으면 목록으로 이동
if (!isset($_GET['post_id'])) {
    echo "<script>
            alert('잘못된 접근입니다.');
            location.href = 'list.php';
          </script>";
    exit;
}

$post_id = $_GET['post_id'];

// 게시글 상세 정보 가져오기
$sql = "
    SELECT 
        posts.post_id,
        posts.user_id,
        posts.title,
        posts.content,
        posts.created_at,
        users.name
    FROM posts
    JOIN users
    ON posts.user_id = users.user_id
    WHERE posts.post_id = $post_id
";

$result = mysqli_query($conn, $sql);

// 게시글이 없을 경우
if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('존재하지 않는 게시글입니다.');
            location.href = 'list.php';
          </script>";
    exit;
}

$post = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Viewing Content</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Bulletin Board &gt; Viewing Content</h2>

    <hr>

    <div>
        <strong>Title:</strong>
        <?php echo htmlspecialchars($post['title']); ?>

        <span style="float: right;">
            <?php echo htmlspecialchars($post['name']); ?>
            |
            <?php echo $post['created_at']; ?>
        </span>
    </div>

    <hr>

    <div style="min-height: 200px;"> 
        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
    </div>

    <br>
    <hr>

    <button type="button" onclick="location.href='list.php'">List</button>
    <button type="button" onclick="location.href='edit.php?post_id=<?php echo $post['post_id']; ?>'">Edit</button>
    <button type="button" onclick="confirmDelete(<?php echo $post['post_id']; ?>)">Delete</button>
    <button type="button" onclick="location.href='write.php'">Write</button>
    <button type="button" onclick="location.href='logout.php'">Logout</button>

    <script>
        function deletePost() {
            const result = confirm("정말 삭제하시겠습니까?");

            if (result) {
                location.href = "delete_process.php?post_id=<?php echo $post['post_id']; ?>";
            }
        }
    </script>
    <script src="script.js"></script>
</body>
</html>
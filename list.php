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

// 게시글 목록 가져오기
$sql = "
    SELECT 
        posts.post_id,
        posts.title,
        posts.created_at,
        users.name
    FROM posts
    JOIN users
    ON posts.user_id = users.user_id
    ORDER BY posts.post_id DESC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bulletin Board List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-box">
    <h2>Bulletin Board &gt; List View</h2>

    <table class="board-table">
        <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Name</th>
            <th>Date</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['post_id']; ?></td>
                <td>
                    <a href="view.php?post_id=<?php echo $row['post_id']; ?>">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </a>
                </td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo date("d/m/Y", strtotime($row['created_at'])); ?></td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <div class="button-area">
            <button type="button" onclick="location.href='write.php'">Write</button>
            <button type="button" onclick="location.href='logout.php'">Logout</button>
    </div>
</body>
</html>
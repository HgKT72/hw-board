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

$sql = "
    SELECT 
        posts.post_id,
        posts.user_id,
        posts.title,
        posts.content,
        users.name
    FROM posts
    JOIN users
    ON posts.user_id = users.user_id
    WHERE posts.post_id = $post_id
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('존재하지 않는 게시글입니다.');
            location.href = 'list.php';
          </script>";
    exit;
}

$post = mysqli_fetch_assoc($result);

if ($post['user_id'] !== $_SESSION['user_id']) {
    echo "<script>
            alert('본인이 작성한 글만 수정할 수 있습니다.');
            location.href = 'view.php?post_id=$post_id';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-box">
        <h2>Bulletin Board &gt; Editing</h2>

        <form class="edit-form" action="edit_process.php" method="post" onsubmit="return checkPostForm()">
            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">

            <div class="form-row">
                <label class="form-label" for="name">Name</label>
                <input
                    class="form-control"
                    type="text"
                    name="name"
                    id="name"
                    value="<?php echo htmlspecialchars($post['name']); ?>"
                    readonly
                >
            </div>

            <div class="form-row">
                <label class="form-label" for="password">Password</label>
                <input
                    class="form-control"
                    type="password"
                    name="password"
                    id="password"
                    required
                >
            </div>

            <div class="form-row">
                <label class="form-label" for="title">Title</label>
                <input
                    class="form-control title-input"
                    type="text"
                    name="title"
                    id="title"
                    value="<?php echo htmlspecialchars($post['title']); ?>"
                    required
                >
            </div>

            <div class="form-row textarea-row">
                <label class="form-label" for="content">Content</label>
                <textarea
                    class="form-control content-textarea"
                    name="content"
                    id="content"
                    required
                ><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>

            <div class="button-area">
                <button type="submit">Save</button>
                <button type="button" onclick="location.href='list.php'">List</button>
                <button type="button" onclick="location.href='logout.php'">Logout</button>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
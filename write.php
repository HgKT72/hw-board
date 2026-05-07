<?php
session_start();

// 로그인하지 않은 사용자는 로그인 페이지로 이동
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('로그인이 필요합니다.');
            location.href = 'index.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Writing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-box">
        <h2>Bulletin Board &gt; Writing</h2>

        <form action="write_process.php" method="post" onsubmit="return checkPostForm()">
            <div class="form-row">
                <label for="name">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value="<?php echo htmlspecialchars($_SESSION['name']); ?>" 
                    readonly
                >
            </div>

            <div class="form-row">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    required
                >
            </div>

            <div class="form-row">
                <label for="title">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="long-input"
                    required
                >
            </div>

            <div class="form-row textarea-row">
                <label for="content">Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    required
                ></textarea>
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
<?php
session_start();

if (isset($_SESSION['user_id'])) {
    echo "<script>
            location.href = 'list.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-box login-box">
        <h2>Login</h2>

        <form class="login-form" action="login_process.php" method="post">
            <div class="form-row">
                <label class="form-label" for="user_id">User ID</label>
                <input
                    class="form-control"
                    type="text"
                    name="user_id"
                    id="user_id"
                    required
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

            <div class="login-button-area">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
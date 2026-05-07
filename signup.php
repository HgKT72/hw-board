<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-box signup-box">
        <h2>Sign Up</h2>

        <form class="signup-form" action="signup_process.php" method="post" onsubmit="return checkSignupForm()">

            <div class="signup-id-row">
                <label class="form-label" for="user_id">User ID</label>
                <input
                    class="form-control"
                    type="text"
                    name="user_id"
                    id="user_id"
                    required
                >
                <button type="button" onclick="checkDuplicate()">Duplicate Check</button>
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
                <label class="form-label" for="password_confirm">Password Confirm</label>
                <input
                    class="form-control"
                    type="password"
                    name="password_confirm"
                    id="password_confirm"
                    required
                >
            </div>

            <div class="form-row">
                <label class="form-label" for="name">Name</label>
                <input
                    class="form-control"
                    type="text"
                    name="name"
                    id="name"
                    required
                >
            </div>

            <div class="form-row">
                <label class="form-label" for="email">Email</label>
                <input
                    class="form-control"
                    type="email"
                    name="email"
                    id="email"
                    required
                >
            </div>

            <div class="button-area">
                <button type="submit">Save</button>
                <button type="button" onclick="location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
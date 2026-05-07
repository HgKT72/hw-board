<?php
session_start();
include "db.php";

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// 1. 등록되지 않은 사용자라면 회원가입 페이지로 이동
if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('등록되지 않은 사용자입니다. 회원가입 페이지로 이동합니다.');
            location.href = 'signup.php';
          </script>";
    exit;
}

// 2. 등록된 사용자라면 비밀번호 확인
$user = mysqli_fetch_assoc($result);

if ($user['password'] !== $password) {
    echo "<script>
            alert('비밀번호가 일치하지 않습니다.');
            history.back();
          </script>";
    exit;
}

// 3. 로그인 성공
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['name'] = $user['name'];

echo "<script>
        alert('로그인 성공');
        location.href = 'list.php';
      </script>";
?>
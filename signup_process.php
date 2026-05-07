<?php
include "db.php";

// signup.php에서 넘어온 값 받기
$user_id = $_POST['user_id'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$name = $_POST['name'];
$email = $_POST['email'];

// 1. 빈칸 검사
if ($user_id == "" || $password == "" || $password_confirm == "" || $name == "" || $email == "") {
    echo "<script>
            alert('모든 항목을 입력하세요.');
            history.back();
          </script>";
    exit;
}

// 2. 비밀번호 확인
if ($password !== $password_confirm) {
    echo "<script>
            alert('비밀번호가 일치하지 않습니다.');
            history.back();
          </script>";
    exit;
}

// 3. 이메일 형식 확인
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
            alert('올바른 이메일 형식이 아닙니다.');
            history.back();
          </script>";
    exit;
}

// 4. User ID 중복 확인
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('이미 존재하는 User ID입니다.');
            history.back();
          </script>";
    exit;
}

// 5. 회원 정보 저장
$sql = "INSERT INTO users (user_id, password, name, email)
        VALUES ('$user_id', '$password', '$name', '$email')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('회원가입이 완료되었습니다. 다시 로그인해주세요.');
            location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('회원가입 실패');
            history.back();
          </script>";
}
?>
# HW-board
프로그램 과제 1 - HTML, CSS, JS, PHP를 사용한 온라인 게시판 개발
– 등록된 사용자는 게시판에서 글을 읽고, 작성하고, 수정하고, 삭제할 수 있음.
– Users와 Posts 릴레이션을 만든 후, 다음 네 명의 사용자가 게시판에 글을 작성함

## 실행 환경

- Windows
- XAMPP Control Panel v3.3.0
- Apache
- MySQL
- PHP
- phpMyAdmin

## 프로젝트 설치 위치

XAMPP의 `htdocs` 폴더 아래에 프로젝트를 둡니다.

```text
C:\xampp\htdocs\hw-board
```

GitHub에서 받은 프로젝트 폴더 이름이 다르다면 `hw-board`로 변경하거나, 접속 URL에서 폴더 이름을 맞춰 주세요.

## 실행 방법

1. XAMPP Control Panel v3.3.0을 실행합니다.
2. `Apache`와 `MySQL`을 Start 합니다.
3. 브라우저에서 phpMyAdmin에 접속합니다.

```text
http://localhost/phpmyadmin
```

4. 새로운 데이터베이스 생성 -> `hw_board` 데이터베이스를 생성합니다.
5. 아래 SQL을 실행해서 테이블을 생성합니다.

```sql
CREATE DATABASE IF NOT EXISTS hw_board
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE hw_board;

CREATE TABLE users (
    user_id VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE posts (
    post_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
```

6. 브라우저에서 프로젝트에 접속합니다.

```text
http://localhost/hw-board
```

## DB 연결 정보

DB 연결 설정은 `db.php`에 있습니다.

```php
$conn = mysqli_connect("localhost", "root", "", "hw_board");
```

XAMPP 기본 설정 기준으로 MySQL 사용자는 `root`, 비밀번호는 빈 값입니다. 팀원 PC에서 MySQL 비밀번호를 따로 설정했다면 `db.php`의 접속 정보를 수정해야 합니다.

## 주요 파일

- `index.php`: 로그인 화면
- `signup.php`: 회원가입 화면
- `list.php`: 게시글 목록
- `write.php`: 게시글 작성
- `view.php`: 게시글 상세 보기
- `edit.php`: 게시글 수정
- `*_process.php`: 로그인, 회원가입, 작성, 수정, 삭제 처리
- `db.php`: DB 연결 설정
- `style.css`: 화면 스타일
- `script.js`: 클라이언트 검증 및 삭제 확인 함수

## 사용 순서

1. 회원가입을 합니다.
(등록되지 않은 아이디/비번으로 로그인 시도시 회원가입으로 이동)
2. 로그인합니다.
3. 게시글을 작성합니다.
4. 목록에서 게시글을 확인하고, 상세 화면에서 수정 또는 삭제할 수 있습니다.

## 참고

SQL Injection 방지, 비밀번호 암호화, CSRF 방어 같은 보안 처리는 과제 요구사항에 없기 때문에 고려하지 않음

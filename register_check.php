<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 데이터베이스 연결 정보
    $servername = "localhost";
    $db_username = "root";
    $db_password = "123";
    $dbname = "stt_data";

    // MySQL 연결
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 입력된 사용자명(또는 이메일)과 일치하는 사용자 찾기
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // 데이터베이스에서 가져온 해시된 비밀번호와 입력된 비밀번호 일치 확인
        if (password_verify($password, $row['password'])) {
            // 로그인 성공
            $_SESSION['user_id'] = $row['id']; // 사용자 ID나 필요한 다른 정보를 세션에 저장
            $_SESSION['email'] = $row['email'];

            header("Location:login_index.html");
            exit();
        } else {
            // 비밀번호가 일치하지 않음
            echo "비밀번호가 일치하지 않습니다.";
        }
    } else {
        // 사용자명(또는 이메일)이 존재하지 않음
        echo "사용자명이 존재하지 않습니다.";
    }

    $conn->close();
}
?>

<?php
// 데이터베이스 연결 정보
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "stt_data";

// 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼에서 사용자 입력 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // 비밀번호 확인
    if ($password != $confirmPassword) {
        die("비밀번호가 일치하지 않습니다.");
    }

    // 이미 있는 아이디인지 체크
    $checkDuplicateSql = "SELECT id FROM users WHERE email = '$email'";
    $duplicateResult = $conn->query($checkDuplicateSql);

    if ($duplicateResult->num_rows > 0) {
        die("이미 사용 중인 아이디입니다.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // 비밀번호를 안전하게 해싱

    // 사용자 데이터를 데이터베이스에 삽입
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "회원가입이 완료되었습니다.";
        header("Location: test.index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// 데이터베이스 연결 종료
$conn->close();
?>

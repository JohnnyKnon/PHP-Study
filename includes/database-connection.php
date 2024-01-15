<?php
$type = 'mysql';       // DB 타입
$server = 'localhost'; // DB 서버
$db = 'phpStudy';      // DB명
$port = '3306';        // DB 일반적으로 포트늩 MAMP에서 8889이고 XAMPP에서 3306 이다.
$charset = "utf8mb4";  //문자당 4바이트의 데이터를 사용하는 UTF-8 인코딩

$username = 'root';
$password = 'alsWkd12!@';

$options = [                // PDO 동작 방법에 대한 옵션
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION ,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      => false,
];                          // PDO 옵션 설정

// 이 줄 아래는 아무것도 변경하지 말자.
$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";  // Data source name(DSN: PDO가 데이터베이스를 찾아 연결에 필요한 필요 5가지 데이터를 보유한 변수 PDO 객체 생성에 사용) 생성
try{
    $pdo = new PDO($dsn, $username, $password, $options);            // PDO 객체 생성
} catch(PDOException $e){                                            // 예외가 발생한 경우
    throw new PDOException($e->getMessage(), $e->getCode());         // 예외를 다시 발생
}
?>
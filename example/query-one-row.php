<?php
// 연결 테스트
require '../includes/database-connection.php';
require '../includes/functions.php';

$sql       = "SELECT forename, surname
                From member
              WHERE id = 1;";
$statement = $pdo->query($sql);
$member    = $statement -> fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST Query-one-row</title>
</head>
<body>
    <p>
        <?= html_escape($member['forename']) ?>
        <?= html_escape($member['surname']) ?>
    </p>
</body>
</html>
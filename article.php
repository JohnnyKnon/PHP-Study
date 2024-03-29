<?php
declare(strict_types = 1);                                   // 엄격한 타입사용
require 'includes/database-connection.php';                 // PDO 객체생성
require 'includes/functions.php';                           // 함수 인클루드
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);   // 아이디 유효성 검사
if (!$id){                                                  // 유효성 아이디가 없다면
    include 'page-not-found.php';                           // 페이지를 찾을 수 없음
}

$sql = "SELECT a.title, a.summary, a.content, a.created, a.category_id, a.member_id,
               c.name       AS category,
               CONCAT(m.forename, ' ', m.surname) AS author,
               i.file AS image_file, i.alt AS image_alt
            FROM article      AS a
            JOIN category     AS c  ON a.category_id = c.id
            JOIN member       AS m  ON a.member_id   = m.id
            LEFT JOIN `image` AS i  ON a.image_id    = i.id
        WHERE a.id = :id      AND a.published = 1;";        // SQL문
$article = $article = pdo($pdo, $sql, [$id])->fetch();      // 기사 데이터 가져오기
if(!$article){                                              // 기사를 찾을 수 없다면
    include 'page-not-found.php';                           // 페이지를 찾을 수 없음
}
$sql = "SELECT id, `name` FROM category WHERE navigation = 1;"; // 카테고리를 가져오는 SQL
$navigation    = pdo($pdo, $sql)->fetchAll();               // 네비게이션 카테고리 가져오기
$section       = $article['category_id'];                   // 현재 카테고리
$title         = $article['title'];                         // HTML <title> 내용
$description   = $article['summary'];                       // 메다 Description 내용
?>
<?php include 'includes/header.php'; ?>
    <main class="article container">
        <section class="image">
            <img src="uploads/<?= html_escape($article['image_file'] ?? 'blank.png') ?>" alt="<?= html_escape($article['image_alt']) ?>" />
        </section>
        <section class="text">
            <h1><?= html_escape($article['title']) ?></h1>
            <div class="date"><?= format_date($article['created']) ?></div>
            <div class="content"><?= html_escape($article['content']) ?></div>
            <p class="credit">
                Posted in <a href="category.php?id=<?= $article['category_id'] ?>"><?= html_escape($article['category']) ?></a>
                by <a href="member.php?id=<?= $article['member_id'] ?>"><?= html_escape($article['author']) ?></a>
            </p>
        </section>
    </main>
<?php include 'includes/footer.php'; ?>
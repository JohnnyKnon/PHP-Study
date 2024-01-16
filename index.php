<?php
// 메인 페이지

declare(strict_types = 1);                  // 엄격한 타입 사용
require 'includes/database-connection.php'; // PDO 객체 생성
require 'includes/functions.php';           // 함수 인클루드

$sql = "SELECT a.id, a.title, a.summary, a.category_id, a.member_id,
                c.name AS category,
                CONCAT(m.forename, ' ', m.surname) AS author,
                i.file       AS image_file,
                i.alt        AS image_alt
            FROM article      AS a
            JOIN category     AS c ON a.category_id = c.id
            JOIN member       AS m ON a.member_id   = m.id
            LEFT JOIN image   AS i ON a.image_id    = i.id
          WHERE a.published = 1
        ORDER BY a.id DESC
            LIMIT 6;";                      // 최근 기사 가져오는 SQL
$articles = pdo($pdo, $sql) -> fetchAll();  // 요약 가져오기

$sql = "SELECT id, `name` FROM category WHERE navigation = 1;"; // 카테고리 가져오는 SQL
$navigation = pdo($pdo, $sql) -> fetchAll();                    // 네비게이션 카테고리 가져오기

$section        = '';                                   // 현재 카테고리
$title          = 'Creative Folk';                      // HTML <title> 내용
$description    = 'A collective of creatives for hire'  // 메타 Description 내용
?>
<!-- 헤더 -->
<?php include 'includes/header.php'; ?>
    <main class="container grid" id="content">
        <?php foreach ($articles as $article) { ?>
            <article class="summary">
                <a href="article.php?id=<?= $article['id'] ?>">
                    <img src="uploads/<?= html_escape($article['image_file'] ?? 'blank.png') ?>" alt="<?= html_escape($article['image_alt']) ?>" />
                    <h2><?= html_escape($article['title']) ?></h2>
                    <p><?= html_escape($article['summary']) ?></p>
                </a>
                <p class="credit">
                    Posted in <a href="category.php?id=<?= $article['category_id'] ?>"><?= html_escape($article['category']) ?></a>
                    by <a href="member.php?id=<?= $article['member_id'] ?>"><?= html_escape($article['author']) ?></a>
                </p>
            </article>
        <?php } ?>
    </main>
<!-- 푸터 -->
<?php include 'includes/footer.php'; ?>
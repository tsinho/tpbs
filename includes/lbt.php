<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
if (!defined('IN_APP')) {
    die('禁止访问');
}
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$sql = "SELECT lbt FROM config WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $lbt = $row['lbt'];
    $carouselItems = explode(',', $lbt);
    echo '<div class="carousel rounded-lg overflow-hidden mb-8">';
    foreach ($carouselItems as $item) {
        list($image, $link) = explode('|', $item);
        echo '<a href="' . htmlspecialchars($link) . '"><div class="carousel-item" style="background-image: url(' . htmlspecialchars($image) . ')"></div></a>';
    }
    echo '</div>';
}
?>

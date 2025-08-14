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

$sql = "SELECT yy_type, yy FROM config WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $yy_type = $row['yy_type'];
    $yy = $row['yy'];

    if ($yy_type == 0) {
        $yy_array = explode(',', $yy);
        $random_yy = $yy_array[array_rand($yy_array)];
        echo $random_yy;
    } elseif ($yy_type == 1) {
        echo $yy;
    }
}
?>

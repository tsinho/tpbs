<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
if (!defined('IN_APP')) {
    die('禁止访问');
}
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$sql = "SELECT qq FROM config WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $qq = $row['qq'];
}
?>
<link rel="icon" type="image/png" href="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $qq;?>&s=100">
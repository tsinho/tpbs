<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
define('IN_APP', true);
include '../../config/database.php';

$name = htmlspecialchars(trim($_POST['name']));
$qq = htmlspecialchars(trim($_POST['qq']));
$content = htmlspecialchars(trim($_POST['content']));
$pid = intval($_POST['pid']);
$ip = $_SERVER['REMOTE_ADDR'];

$time = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO comments (id, name, qq, content, time, ip, pid) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $name, $qq, $content, $time, $ip, $pid);

if ($stmt->execute()) {
    header("Location:post.php?id=".$pid."&result=0#comments");
} else {
    header("Location:post.php?id=".$pid."&result=1#comments");
}

$stmt->close();
$conn->close();
?>
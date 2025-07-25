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
$servername = "localhost";    // 服务器地址
$username = "tpbs";         // 数据库用户名
$password = "123456";           // 数据库密码
$dbname = "tpbs";         // 数据库名称

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>
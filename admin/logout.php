<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
 //登出清除cookie信息
session_start();
setcookie('tpbs', '', time() - 3600, '/');
header('Location: login.php');
exit;
?>
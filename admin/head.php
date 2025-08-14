<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
session_start();
define('IN_APP', true);
require_once '../config/database.php';

$is_logged_in = false;
if (!empty($_COOKIE['tpbs'])) {
    $cookie = $_COOKIE['tpbs'];
    $result = $conn->query("SELECT cookie FROM config WHERE id=1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($cookie === $row['cookie']) {
            $is_logged_in = true;
        }
    }
}

if (!$is_logged_in) {
    header('Location: login.php');
    exit;
}

$result = $conn->query("SELECT name, qq FROM config WHERE id=1");
$admin_info = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>青和后台管理系统</title>
    <link rel="stylesheet" href="../assets/css/fontawesome/css/all.min.css">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $admin_info['qq']; ?>&s=100" alt="管理员头像">
            <div class="admin-info">
                <h3><?php echo htmlspecialchars($admin_info['name']); ?></h3>
                <p>管理员</p>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <a href="index.php" class="menu-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'index.php' ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>仪表盘
            </a>
            <a href="posts.php" class="menu-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'posts.php' ? 'active' : ''; ?>">
                <i class="fas fa-file-alt"></i>文章管理
            </a>
            <a href="comments.php" class="menu-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'comments.php' ? 'active' : ''; ?>">
                <i class="fas fa-comments"></i>评论管理
            </a>
            <a href="message.php" class="menu-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'message.php' ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i>留言管理
            </a>
            <a href="image.php" class="menu-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'image.php' ? 'active' : ''; ?>">
                <i class="fas fa-image"></i>图片上传
            </a>
            <a href="config.php" class="menu-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'config.php' ? 'active' : ''; ?>">
                <i class="fas fa-cog"></i>系统设置
            </a>
            <a href="logout.php" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>退出登录
            </a>
        </div>
    </div>
    
    <div class="content">
        <div class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="topbar-right">
                
                <div class="user-dropdown">
                    <button class="user-btn">
                        <img src="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $admin_info['qq']; ?>&s=100" alt="用户头像">
                        <span><?php echo htmlspecialchars($admin_info['name']); ?></span>
                        <i class="fas fa-caret-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="config.php" class="dropdown-item">
                            <i class="fas fa-user"></i>个人设置
                        </a>
                        <a href="logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>退出登录
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">

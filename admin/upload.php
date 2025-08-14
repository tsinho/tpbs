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

// 验证cookie
if (empty($_COOKIE['tpbs'])) {
    die(json_encode(['success' => false, 'message' => '未授权访问']));
}

$cookie = $_COOKIE['tpbs'];
$result = $conn->query("SELECT cookie FROM config WHERE id=1");
if ($result->num_rows == 0 || $result->fetch_assoc()['cookie'] !== $cookie) {
    die(json_encode(['success' => false, 'message' => '未授权访问']));
}

// 处理文件上传
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // 检查错误
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die(json_encode(['success' => false, 'message' => '上传错误: ' . $file['error']]));
    }
    
    // 验证文件类型
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowed_types)) {
        die(json_encode(['success' => false, 'message' => '只允许上传 JPG, PNG, GIF 或 WebP 格式的图片']));
    }
    
    // 验证文件大小 (最大5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        die(json_encode(['success' => false, 'message' => '图片大小不能超过5MB']));
    }
    
    // 生成随机文件名
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = uniqid('img_') . '_' . bin2hex(random_bytes(5)) . '.' . $extension;
    
    // 上传目录
    $upload_dir = '../assets/image/upload/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // 移动文件
    $destination = $upload_dir . $new_filename;
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        // 获取协议和域名
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $domain = $_SERVER['HTTP_HOST'];
        
        // 返回URL
        $url = $protocol . $domain . '/assets/image/upload/' . $new_filename;
        echo json_encode(['success' => true, 'url' => $url]);
    } else {
        echo json_encode(['success' => false, 'message' => '文件移动失败']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '无效的请求']);
}
?>

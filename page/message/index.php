<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
define('IN_APP', true);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>个人主页 - 留言</title>
    <script src="https://cdn.tailwindcss.com/3.3.3"></script>
    <link rel="stylesheet" href="../../assets/css/fontawesome/css/all.min.css">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
    <link rel="stylesheet" href="../../assets/font/dinglie/font.css" rel="preconnect">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <!-- 加载动画 -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>
    
    <?php
    include('../../includes/nav.php');
    ?>
    
    <!-- 留言页内容 -->
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <button onclick="ToPage()" class="mb-8 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition flex items-center">
            <i class="fas fa-pencil-alt mr-2"></i> 我要留言
        </button>
        
        <!-- 留言示例 -->
        <div class="space-y-6">
            <?php
include '../../config/database.php';

$sql = "SELECT name, qq, content, time FROM message";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = htmlspecialchars($row['name']);
        $qq = htmlspecialchars($row['qq']);
        $content = htmlspecialchars($row['content']);
        $time = date("Y-m-d", strtotime($row['time']));
        
        echo '<div class="bg-white rounded-lg shadow-md p-6 card-hover">
                <div class="flex items-start">
                    <img src="http://q1.qlogo.cn/g?b=qq&nk=' . $qq . '&s=100" alt="用户头像" class="comment-avatar rounded-full mr-4">
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-semibold">' . $name . '</h4>
                            <span class="text-sm text-gray-500">' . $time . '</span>
                        </div>
                        <p style="font-family: \'dingliezhuhaifont\',Sans-Serif" class="text-gray-700 mb-3">' . $content . '</p>
                    </div>
                </div>
            </div>';
    }
} else {
    echo "查询失败: " . mysqli_error($conn);
}
?>
        </div>
    </div>
    
    <?php
    include('../../includes/footer.php');
    ?>
    <script>
        function ToPage() {
            window.location.href = 'post.php';
        }
    </script>
    <script src="../../assets/js/script.js"></script>
</body>
</html>
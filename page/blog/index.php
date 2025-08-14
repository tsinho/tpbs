<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
define('IN_APP', true);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>个人主页 - 博客</title>
    <script src="https://cdn.tailwindcss.com/3.3.3"></script>
    <link rel="stylesheet" href="../../assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/font/dingliesongketi/font.css" rel="preconnect">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
</head>
<body>
    <!-- 加载动画 -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>
    
    <?php
    include('../../includes/nav.php');
    ?>
    
    <!-- 博客页内容 -->
    <div class="container mx-auto px-4 py-8">
        <!-- 轮播图 -->
        <?php include('../../includes/lbt.php');?>
        
        <!-- 文章列表 -->
        <div class="space-y-6">
            <?php
require '../../config/database.php';

$sql = "SELECT title, id, content, view, time, fm FROM posts";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = htmlspecialchars($row['title']);
        $content = strip_tags($row['content']);
        $summary = substr($content, 0, 150) . '...';
        $view = htmlspecialchars($row['view']);
        $id = htmlspecialchars($row['id']);
        $time = htmlspecialchars($row['time']);
        $fm = htmlspecialchars($row['fm']);
        $formatted_time = date("Y/m/d", strtotime($time));
        $formatted_view = formatViewCount($view);

        echo '<a href="post.php?id='.$id.'"><div class="bg-white rounded-lg shadow-md overflow-hidden card-hover">
                <div class="md:flex">
                    <div class="md:w-1/3">
                        <img src="' . $fm . '" alt="文章封面" class="w-full h-full article-cover">
                    </div>
                    <div class="p-6 md:w-2/3">
                        <h3 class="text-xl font-semibold mb-2" style="font-family: \'dingliesongtypeface\',Sans-Serif">' . $title . '</h3>
                        <p class="text-gray-600 mb-4" style="font-family: \'dingliesongtypeface\',Sans-Serif">' . $summary . '</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-4"><i class="far fa-eye mr-1"></i> ' . $formatted_view . '</span>
                            <span><i class="far fa-clock"></i> ' . $formatted_time . '</span>
                        </div>
                    </div>
                </div>
            </div></a><br>';
    }
} else {
    echo '<center>文章列表为空！</center>';
}
function formatViewCount($view) {
    if ($view >= 1000) {
        if ($view % 1000 === 0) {
            return ($view / 1000) . 'k';
        } else {
            return number_format($view / 1000, 1) . 'k';
        }
    } else {
        return $view;
    }
}
?>
            
        </div>
    </div>
    
    <?php
    include('../../includes/footer.php');
    ?>
    
    <script src="../../assets/js/script.js"></script>
</body>
</html>

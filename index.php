<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
define('IN_APP', true);
require 'config/database.php';

$sql = "SELECT name, place, qq, wechat, email FROM config WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $place = $row['place'];
    $qq = $row['qq'];
    $wechat = $row['wechat'];
    $email = $row['email'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>个人主页 - 首页</title>
    <script src="https://cdn.tailwindcss.com/3.3.3"></script>
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/font/dinglie/font.css" rel="preconnect">
    <link rel="stylesheet" href="assets/css/style.css">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
</head>
<body>
    <!-- 加载动画 -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>
    
    <?php
    include('includes/nav.php');
    ?>
    
    <!-- 首页内容 -->
    <div class="container mx-auto px-4 py-8">
        <!-- 个人信息 -->
        <div class="flex flex-col items-center mb-12">
            <img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $qq;?>&s=100" alt="头像" class="avatar rounded-full mb-4">
            <h1 class="text-3xl font-bold mb-2"><?php echo $name;?></h1>
            <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt mr-1"></i> <?php echo $place;?></p>
            
            <!-- 个人爱好 -->
            <div class="flex flex-wrap justify-center gap-3 mb-6">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full"><i class="fas fa-music mr-1"></i> 音乐</span>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full"><i class="fas fa-book mr-1"></i> 编程</span>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full"><i class="fas fa-plane mr-1"></i> 旅行</span>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full"><i class="fas fa-camera mr-1"></i> 摄影</span>
            </div>
            
            <!-- 格言 -->
            <div class="max-w-2xl mx-auto bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg" style="font-family: 'dingliezhuhaifont',Sans-Serif">
                <p class="text-gray-700 italic"><i class="fas fa-quote-left text-blue-500 mr-2"></i><?php include 'includes/yy.php'; ?><i class="fas fa-quote-right text-blue-500 ml-2"></i></p>
            </div>
        </div>
        
        <!-- 联系方式 -->
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6 mb-8 card-hover">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <div class="contact-icon rounded-full flex items-center justify-center text-white mr-3">
                    <i class="fas fa-envelope"></i>
                </div>
                联系方式
            </h2>
            
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                        <i class="fab fa-qq"></i>
                    </div>
                    <span>QQ: <?php echo $qq;?></span>
                </div>
                
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                        <i class="fab fa-weixin"></i>
                    </div>
                    <span>微信: <?php echo $wechat;?></span>
                </div>
                
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <span>邮箱: <?php echo $email;?></span>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    include('includes/footer.php');
    ?>
    
    <script src="assets/js/script.js"></script>
</body>
</html>

<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
define('IN_APP', true);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die('参数id不是有效值');
}
require '../../config/database.php';
$id = intval($id);
$stmt = $conn->prepare("UPDATE posts SET view = view + 1 WHERE id = ?");
$stmt->bind_param("i", $id);
$result = $stmt->execute();
$stmt->close();
$stmt = $conn->prepare("SELECT title, content, author_qq, author, view, time, fm FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
    $author_qq = $row['author_qq'];
    $author = $row['author'];
    $view = formatViewCount($row['view']);
    $time = $row['time'];
    $fm = $row['fm'];
}
function formatViewCount($count) {
    if ($count >= 1000) {
        if ($count % 1000 === 0) {
            return ($count / 1000) . 'k';
        } else {
            return number_format($count / 1000, 1) . 'k';
        }
    } else {
        return $count;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?> - 文章详情</title>
    <script src="https://cdn.tailwindcss.com/3.3.3"></script>
    <link rel="stylesheet" href="../../assets/css/fontawesome/css/all.min.css">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/blog.css">
    <style>
        .article-content img {
            max-width: 100%;
            height: auto;
            margin: 1.5rem 0;
            border-radius: 0.5rem;
        }
        
        .article-content p {
            margin-bottom: 1rem;
            line-height: 1.8;
        }
        
        .article-content h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 1.5rem 0 1rem;
            color: #1e40af;
        }
        
        .comment-input {
            resize: none;
            min-height: 120px;
        }
    </style>
</head>
<body>
    <!-- 加载动画 -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- 导航栏 -->
    <?php
    include '../../includes/nav.php';
    ?>
    
    <!-- 文章详情内容 -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- 文章头部信息 -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800"><?php echo $title;?></h1>
            
            <div class="flex flex-wrap items-center text-gray-600 mb-6">
                <div class="flex items-center mr-6 mb-2 md:mb-0">
                    <img src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $author_qq;?>&s=100" alt="作者头像" class="w-10 h-10 rounded-full mr-3">
                    <span><?php echo $author;?></span>
                </div>
                <div class="flex items-center mr-6 mb-2 md:mb-0">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span><?php echo $time;?></span>
                </div>
                <div class="flex items-center mb-2 md:mb-0">
                    <i class="far fa-eye mr-2"></i>
                    <span><?php echo $view;?> 阅读</span>
                </div>
            </div>
            
            <!-- 文章封面图 -->
            <div class="rounded-lg overflow-hidden mb-8 shadow-md">
                <img src="<?php echo $fm;?>" alt="文章封面" class="w-full h-auto">
            </div>
        </div>
        
        <!-- 文章内容 -->
        <div class="article-content bg-white rounded-lg shadow-md p-6 md:p-8 mb-10">
        <?php echo $content;?>
        </div>
        
        
        
        
        
        <!-- 评论区 -->
        <div id="comments" class="bg-white rounded-lg shadow-md p-6 md:p-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <i class="fas fa-comments text-blue-600 mr-2"></i>
                评论区
            </h2>
            
            <!-- 评论输入框 -->
            <form method="post" action="submit.php">
            <div class="mb-8 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="name" type="text" placeholder="请输入昵称" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <input name="qq" type="text" placeholder="请输入QQ号" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <textarea name="content" class="comment-input w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="写下你的评论..."></textarea>
                <input name="pid" value="<?php echo $id;?>" style="display:none">
                <div class="flex justify-end">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition">
                        发表评论
                    </button>
                </div>
            </div></form>
            <?php
            //评论API结果传入
if (isset($_GET['result'])) {
    $result = intval($_GET['result']);
    if ($result === 0) {
        echo '<div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <ul class="error-message space-y-1">
                    <li><i class="fas fa-check-circle mr-1"></i>发布成功！</li>
                </ul>
            </div>';
    } elseif ($result === 1) {
        echo '<div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <ul class="error-message space-y-1">
                    <li><i class="fas fa-exclamation-circle mr-1"></i>发布失败！</li>
                </ul>
            </div>';
    } else {
        echo '<div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <ul class="error-message space-y-1">
                    <li><i class="fas fa-exclamation-circle mr-1"></i>系统错误！</li>
                </ul>
            </div>';
    }
}
?>
            
            <!-- 评论列表 -->
            <div class="space-y-6">
                <?php
include '../../config/database.php';

$sql = "SELECT name, qq, content, time FROM comments WHERE pid = ".$id;
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = htmlspecialchars($row['name']);
        $qq = htmlspecialchars($row['qq']);
        $content = htmlspecialchars($row['content']);
        $time = date("Y-m-d", strtotime($row['time']));
        
        echo '<div class="border-b border-gray-200 pb-6">
                    <div class="flex items-start">
                        <img src="http://q1.qlogo.cn/g?b=qq&nk='.$qq.'&s=100" alt="用户头像" class="comment-avatar rounded-full mr-4">
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold">'.$name.'</h4>
                                <span class="text-sm text-gray-500">'.$time.'</span>
                            </div>
                            <p class="text-gray-700 mb-3">'.$content.'</p>
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
    </div>
    
    <!-- 页脚 -->
    <?php
    include('../../includes/footer.php');
    ?>
    
    <script src="../../assets/js/script.js"></script>
</body>
</html>

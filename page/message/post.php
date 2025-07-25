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
    <title>个人主页 - 发布留言</title>
    <script src="https://cdn.tailwindcss.com/3.3.3"></script>
    <link rel="stylesheet" href="../../assets/css/fontawesome/css/all.min.css">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .form-input:focus {
            @apply focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent;
        }
        .error-message {
            @apply text-red-500 text-sm mt-1;
        }
    </style>
</head>
<body>
    <!-- 加载动画 -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- 导航栏 -->
    <?php include('../../includes/nav.php');?>
    
    <!-- 留言发布内容 -->
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <i class="fas fa-pencil-alt text-blue-600 mr-2"></i>
                发布留言
            </h2>
            
            <?php
            // 处理表单提交
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // 引入数据库配置文件
                require '../../config/database.php';
                
                $name = trim($_POST['name']);
                $qq = trim($_POST['qq']);
                $content = trim($_POST['content']);
                $time = date('Y-m-d H:i:s');
                $ip = $_SERVER['REMOTE_ADDR'];
                
                $errors = [];
                if (empty($name)) {
                    $errors[] = "请输入昵称";
                }
                if (empty($qq) || !preg_match('/^\d{5,13}$/', $qq)) {
                    $errors[] = "请输入有效的QQ号";
                }
                if (empty($content)) {
                    $errors[] = "请输入留言内容";
                }
                
                if (empty($errors)) {
                    $sql = "INSERT INTO message (name, qq, content, time, ip) 
                            VALUES ('" . mysqli_real_escape_string($conn, $name) . "', 
                                    '" . mysqli_real_escape_string($conn, $qq) . "', 
                                    '" . mysqli_real_escape_string($conn, $content) . "', 
                                    '" . $time . "', 
                                    '" . mysqli_real_escape_string($conn, $ip) . "')";

                    if (mysqli_query($conn, $sql)) {
                          $success[] = "留言提交成功！";
                    } else {
                        $errors[] = "留言提交失败，请稍后再试";
                    }
                    
                    mysqli_close($conn);
                }
            }
            ?>
            
            <!-- 错误提示 -->
            <?php if (!empty($errors)): ?>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <ul class="error-message space-y-1">
                    <?php foreach ($errors as $error): ?>
                    <li><i class="fas fa-exclamation-circle mr-1"></i><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <!-- 成功提示 -->
            <?php if (!empty($success)): ?>
            <script>window.location.href = 'index.php';</script>
            <?php endif; ?>
            
            <!-- 留言表单 -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-gray-700 mb-2">昵称</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" 
                               class="form-input w-full p-4 border border-gray-300 rounded-lg" placeholder="请输入您的昵称">
                    </div>
                    
                    <div>
                        <label for="qq" class="block text-gray-700 mb-2">QQ号</label>
                        <input type="text" id="qq" name="qq" value="<?php echo isset($_POST['qq']) ? htmlspecialchars($_POST['qq']) : ''; ?>" 
                               class="form-input w-full p-4 border border-gray-300 rounded-lg" placeholder="请输入您的QQ号">
                    </div>
                    
                    <div>
                        <label for="content" class="block text-gray-700 mb-2">留言内容</label>
                        <textarea id="content" name="content" rows="5" 
                                  class="form-input w-full p-4 border border-gray-300 rounded-lg" placeholder="请输入您的留言内容"><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-4 pt-2">
                        <button type="button" onclick="window.history.back()" 
                                class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            取消
                        </button>
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition">
                            发布留言
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- 页脚 -->
    <?php include('../../includes/footer.php');?>
    
    <script src="../../assets/js/script.js"></script>
</body>
</html>
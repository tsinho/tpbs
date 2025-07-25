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
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$sql = "SELECT beian , name FROM config WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $beian = $row['beian'];
}
$conn->close();
?>
<!-- 页脚 -->
    <div class="footer"><footer class="tencent-blue text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>© 2025 <?php echo $name;?> All rights reserved.<br><a href="http://beian.miit.gov.cn"><?php echo $beian;?></a></p>
        </div>
    </footer></div>
    <script>
        window.addEventListener('load', function() {
            var body = document.body;
            var footer = document.querySelector('.footer');
            var rect = footer.getBoundingClientRect();
            var windowHeight = window.innerHeight;
            var bodyHeight = body.offsetHeight;
            if (bodyHeight < windowHeight) {
                footer.style.position = 'fixed';
                footer.style.bottom = '0';
                footer.style.width = '100%';
            } else {
                footer.style.position = 'static';
            }
        });
    </script>
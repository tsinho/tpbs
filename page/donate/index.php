<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
define('IN_APP', true);
require '../../config/database.php';

$sql = "SELECT wxpay, alipay FROM config WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $wxpay = $row['wxpay'];
    $alipay = $row['alipay'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>个人主页 - 捐赠</title>
    <script src="https://cdn.tailwindcss.com/3.3.3"></script>
    <link rel="stylesheet" href="../../assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
    <link rel="stylesheet" href="../../assets/css/donate.css">
</head>
<body>
    <!-- 加载动画 -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>
    
    <?php
    include('../../includes/nav.php');
    ?>
    
    <!-- 捐赠页内容 -->
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-heart text-3xl text-blue-600"></i>
            </div>
            
            <h2 class="text-2xl font-bold mb-4">支持我的创作</h2>
            <p class="text-gray-600 mb-8">您的支持是我持续创作的动力，感谢您的慷慨捐赠！</p>
            
            <div class="grid grid-cols-2 gap-4 mb-8">
                <button onclick="openModal('wxpay')" class="py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fab fa-weixin mr-2"></i> 微信支付
                </button>
                <button onclick="openModal('alipay')" class="py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fab fa-alipay mr-2"></i> 支付宝
                </button>
            </div>
            
            <p class="text-sm text-gray-500">所有捐赠将用于内容创作和服务器维护</p>
        </div>
    </div>

    <!-- 模态弹窗 -->
    <div id="donateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">请使用<span id="donateType"></span>扫描二维码</h2>
            <img id="qrCode" src="" alt="二维码">
        </div>
    </div>

    <script>
        // 定义打开模态弹窗的函数
        function openModal(type) {
            const modal = document.getElementById('donateModal');
            const modalTitle = document.getElementById('modalTitle');
            const donateTypeSpan = document.getElementById('donateType');
            const qrCodeImg = document.getElementById('qrCode');

            if (type === 'wxpay') {
                modalTitle.textContent = '请使用微信扫描二维码';
                qrCodeImg.src = '<?php echo $wxpay;?>';
            } else if (type === 'alipay') {
                modalTitle.textContent = '请使用支付宝扫描二维码';
                qrCodeImg.src = '<?php echo $alipay;?>';
            }

            modal.style.display = 'flex';
        }

        // 定义关闭模态弹窗的函数
        function closeModal() {
            const modal = document.getElementById('donateModal');
            modal.style.display = 'none';
        }
    </script>
    
    
    <?php
    include('../../includes/footer.php');
    ?>
    
    <script src="../../assets/js/script.js"></script>
</body>
</html>

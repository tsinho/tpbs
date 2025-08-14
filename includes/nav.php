<?php
/*
 * 青和个人主页博客系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
if (!defined('IN_APP')) {
    die('禁止访问');
}
?>
<!-- 导航栏 -->
    <nav class="tencent-blue text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/"><div class="text-xl font-bold">个人主页</div></a>
            <div class="hidden md:flex space-x-6">
                <a href="/index.php" class="nav-link"><i class="fas fa-home mr-1"></i> 首页</a>
                <a href="/page/blog" class="nav-link"><i class="fas fa-book mr-1"></i> 博客</a>
                <a href="/page/donate" class="nav-link"><i class="fas fa-heart mr-1"></i> 捐赠</a>
                <a href="/page/message" class="nav-link"><i class="fas fa-comment mr-1"></i> 留言</a>
            </div>
            <button class="md:hidden text-white focus:outline-none" id="mobileMenuButton">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        
        <!-- 移动端菜单 -->
        <div class="md:hidden hidden bg-white shadow-lg" id="mobileMenu">
            <div class="container mx-auto px-4 py-2 flex flex-col">
                <a href="/index.php" class="nav-link py-2 text-gray-800"><i class="fas fa-home mr-2"></i> 首页</a>
                <a href="/page/blog" class="nav-link py-2 text-gray-800"><i class="fas fa-book mr-2"></i> 博客</a>
                <a href="/page/donate" class="nav-link py-2 text-gray-800"><i class="fas fa-heart mr-2"></i> 捐赠</a>
                <a href="/page/message" class="nav-link py-2 text-gray-800"><i class="fas fa-comment mr-2"></i> 留言</a>
            </div>
        </div>
    </nav>

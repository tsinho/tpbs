-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2025-07-26 00:25:55
-- 服务器版本： 5.7.43-log
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `tpbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `content` text NOT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(45) DEFAULT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `comments`
--

INSERT INTO `comments` (`id`, `name`, `qq`, `content`, `time`, `ip`, `pid`) VALUES
(12, '青和', '1722791510', '评论测试', '2025-07-25 17:12:20', '127.0.0.1', 4),
(13, '青和', '1722791510', '评论测试1', '2025-07-25 18:21:15', '127.0.0.1', 5);

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

CREATE TABLE `config` (
  `id` int(11) UNSIGNED NOT NULL,
  `admin` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `wechat` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `beian` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `place` varchar(100) DEFAULT NULL,
  `yy_type` tinyint(1) DEFAULT NULL,
  `yy` varchar(100) DEFAULT NULL,
  `wxpay` text,
  `alipay` text,
  `lbt` text,
  `cookie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `admin`, `password`, `qq`, `wechat`, `email`, `beian`, `name`, `place`, `yy_type`, `yy`, `wxpay`, `alipay`, `lbt`, `cookie`) VALUES
(1, 'admin', '$2a$10$unBernge5UXTIf.HxNipOeBu1hYQGaW84FEvRUQAjJAkL8XdCUlIm', '1722791510', 'yy1722791510', 'admin@tsinho.cn', '黔ICP备2023062478号', 'Tsinho.', '贵州', 1, '咸鱼翻身不是为了崛起，可能只是想两边都晒晒。', 'https://p3.a.yximgs.com/upic/2025/07/25/22/BMjAyNTA3MjUyMjA0MTRfMTU1NzAzMDAyNF8xNzA0ODU3Mjk2MzJfMl82_B0482bb13552ad195c86481212b7e0202.jpg', 'https://p1.a.yximgs.com/upic/2025/07/25/21/BMjAyNTA3MjUyMTUxMjZfMTU1NzAzMDAyNF8xNzA0ODQ1MDk5NDNfMl82_B0b74e361bbc996dc3c7d0f328de7c90c.jpg', 'https://p4.a.yximgs.com/upic/2025/07/25/21/BMjAyNTA3MjUyMTUxNDRfMTU1NzAzMDAyNF8xNzA0ODQ1Mzk0NjNfMl82_Bbd2e7c471e8cac5fa1a8dac8384ae8e7.jpg|mailto:admin@tsinho.cn,https://p1.a.yximgs.com/upic/2025/07/25/21/BMjAyNTA3MjUyMTUxNThfMTU1NzAzMDAyNF8xNzA0ODQ1NjEyODVfMl82_Bb6ad421ca5fb8ce1b799ef311d12b062.jpg|mailto:admin@tsinho.cn', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `content` text NOT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `name`, `qq`, `content`, `time`, `ip`) VALUES
(4, 'tsinho', '1722791510', '留言测试', '2025-07-15 22:41:01', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_qq` varchar(20) DEFAULT NULL,
  `view` int(11) DEFAULT '0',
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `fm` varchar(255) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author_qq`, `view`, `time`, `fm`, `author`) VALUES
(4, 'TPBS青和个人主页博客系统', '    <style>\r\n        h1, h2, h3 {\r\n            color: #2c3e50;\r\n            margin-top: 30px;\r\n        }\r\n        h1 {\r\n            border-bottom: 2px solid #3498db;\r\n            padding-bottom: 10px;\r\n        }\r\n        h2 {\r\n            border-left: 4px solid #3498db;\r\n            padding-left: 15px;\r\n        }\r\n        code {\r\n            background-color: #f0f0f0;\r\n            padding: 2px 5px;\r\n            border-radius: 3px;\r\n            font-family: Consolas, monospace;\r\n        }\r\n        pre {\r\n            background-color: #282c34;\r\n            color: #abb2bf;\r\n            padding: 15px;\r\n            border-radius: 5px;\r\n            overflow-x: auto;\r\n        }\r\n        table {\r\n            width: 100%;\r\n            border-collapse: collapse;\r\n            margin: 20px 0;\r\n        }\r\n        th, td {\r\n            border: 1px solid #ddd;\r\n            padding: 12px;\r\n            text-align: left;\r\n        }\r\n        th {\r\n            background-color: #3498db;\r\n            color: white;\r\n        }\r\n        tr:nth-child(even) {\r\n            background-color: #f2f2f2;\r\n        }\r\n        .note {\r\n            background-color: #e7f5fe;\r\n            border-left: 4px solid #3498db;\r\n            padding: 15px;\r\n            margin: 20px 0;\r\n        }\r\n        .warning {\r\n            background-color: #fff3bf;\r\n            border-left: 4px solid #ffd43b;\r\n            padding: 15px;\r\n            margin: 20px 0;\r\n        }\r\n        .feature-list {\r\n            display: grid;\r\n            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));\r\n            gap: 15px;\r\n            margin: 20px 10 0 0;\r\n        }\r\n        .feature-item {\r\n            margin-right: 10px;\r\n            background-color: white;\r\n            padding: 15px;\r\n            border-radius: 5px;\r\n            box-shadow: 0 2px 5px rgba(0,0,0,0.1);\r\n        }\r\n        .license-badge {\r\n            display: inline-block;\r\n            background-color: #2c3e50;\r\n            color: white;\r\n            padding: 5px 10px;\r\n            border-radius: 3px;\r\n            font-size: 0.9em;\r\n            margin: 5px 0;\r\n        }\r\n    </style>\r\n    <article>\r\n        <h1>青和个人主页博客系统 (TPBS)</h1>\r\n        \r\n      \r\n        \r\n        <p><code>Tsinho Personal Blog System</code> 是一个简约的个人主页/博客系统，支持文章发布、捐赠功能和访客留言。</p>\r\n        \r\n        <h2>系统特性</h2>\r\n        \r\n        <div class=\"feature-list\">\r\n            <div class=\"feature-item\">\r\n                <h3>🌐 个人主页/博客</h3>\r\n                <p>既可作个人主页展示，也可作为博客/日记系统</p>\r\n            </div>\r\n            <div class=\"feature-item\">\r\n                <h3>💰 捐赠功能</h3>\r\n                <p>支持自定义收款码（微信/支付宝）</p>\r\n            </div>\r\n            <div class=\"feature-item\">\r\n                <h3>📝 留言板</h3>\r\n                <p>访客互动交流</p>\r\n            </div>\r\n            <div class=\"feature-item\">\r\n                <h3>🎨 简约UI</h3>\r\n                <p>商务蓝配色方案，响应式设计</p>\r\n            </div>\r\n            <div class=\"feature-item\">\r\n                <h3>🔒 安全设计</h3>\r\n                <p>后台密码使用bcrypt加密 + 模块访问控制</p>\r\n            </div>\r\n            <div class=\"feature-item\">\r\n                <h3>📦 轻量架构</h3>\r\n                <p>PHP+MySQL驱动，前端原生技术</p>\r\n            </div>\r\n        </div>\r\n        \r\n        <h2>技术栈</h2>\r\n        \r\n        <table>\r\n            <thead>\r\n                <tr>\r\n                    <th>模块</th>\r\n                    <th>技术</th>\r\n                </tr>\r\n            </thead>\r\n            <tbody>\r\n                <tr>\r\n                    <td>前端</td>\r\n                    <td>HTML5, CSS3, JavaScript</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>后端</td>\r\n                    <td>PHP 7.0+</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>数据库</td>\r\n                    <td>MySQL 5.6+</td>\r\n                </tr>\r\n                <tr>\r\n                    <td>加密</td>\r\n                    <td>bcrypt</td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n        \r\n        <h2>安装指南</h2>\r\n        \r\n        <ol>\r\n            <li>将项目部署到PHP站点根目录（Apache/Nginx）</li>\r\n            <li>导入<code>database.sql</code>到MySQL</li>\r\n            <li>配置<code>/config/database.php</code></li>\r\n     \r\n        </ol>\r\n        \r\n        <h2>安全说明</h2>\r\n        \r\n        <div class=\"warning\">\r\n            <p>❗ 二改源代码时，涉及引用数据库配置文件以及<code>根目录/includes/</code>目录下所有文件时需要加入以下代码定义环境为处于软件程序内：</p>\r\n            <pre><code>defined(\'IN_APP\');</code></pre>\r\n        </div>\r\n        \r\n        <p>数据库配置文件位置：</p>\r\n        <pre><code>/config/database.php</code></pre>\r\n        \r\n        <h2>版权与使用</h2>\r\n        \r\n        <ul>\r\n            <li><strong>开发者</strong>：青和</li>\r\n            <li><strong>联系方式</strong>：\r\n                <ul>\r\n                    <li>QQ：1722791510</li>\r\n                    <li>邮箱：admin@tsinho.cn</li>\r\n                </ul>\r\n            </li>\r\n            <li><strong>授权条款</strong>：\r\n                <ul>\r\n                    <li>✅ 允许二次开发（需保留原始版权信息）</li>\r\n                    <li>✅ 允许非商业用途修改使用</li>\r\n                    <li>❌ 禁止源代码倒卖/商业转售</li>\r\n                    <li>❌ 禁止删除开发者信息</li>\r\n                </ul>\r\n            </li>\r\n        </ul>\r\n        \r\n        <h2>未来计划</h2>\r\n        \r\n        <ul>\r\n            <li>加入富文本编辑器</li>\r\n            <li>多主题支持</li>\r\n            <li>PC端优化</li>\r\n        </ul>\r\n        \r\n        <h2>共建指南</h2>\r\n        \r\n        <p>欢迎提交改进建议至开发者邮箱，发现安全漏洞请及时反馈。</p>\r\n        \r\n        <hr>\r\n        \r\n        <div class=\"note\">\r\n            <h3>📜 开源许可证</h3>\r\n            <p>本程序源码使用 <span class=\"license-badge\">GNU AGPLv3</span> 开源许可证，禁止商业倒卖，允许二次开发（需在代码中保留原开发者信息）。</p>\r\n            \r\n            <h3>青和 © 2025 版权所有</h3>\r\n        </div>\r\n    </article>\r\n</body>\r\n</html>', '1722791510', 25, '2025-07-25 16:48:59', 'https://p4.a.yximgs.com/upic/2025/07/25/21/BMjAyNTA3MjUyMTUxNDRfMTU1NzAzMDAyNF8xNzA0ODQ1Mzk0NjNfMl82_Bbd2e7c471e8cac5fa1a8dac8384ae8e7.jpg', '青和'),
(5, '测试文章', '<article class=\"blog-article\"> \r\n<h1 class=\"article-title\">博客文章美化测试页面</h1>\r\n<h2 class=\"article-subtitle\">子标题1</h2>\r\n<p class=\"article-text\">这是普通段落文本...</p>\r\n<h2 class=\"article-subtitle\">子标题2</h2>\r\n<p class=\"article-highlight\">这是高亮段落文本...</p>\r\n<h2 class=\"article-subtitle\">子标题3</h2>\r\n<p class=\"article-quote\">这是引用文本...</p>\r\n<h2 class=\"article-subtitle\">子标题4</h2>\r\n<h3 class=\"article-section\">有序列表</h3>\r\n<ol class=\"article-list\"> <li>第一项</li> <li>第二项</li> <li>第三项</li> </ol>\r\n<h3 class=\"article-section\">无序列表</h3>\r\n<ul class=\"article-list\"> <li>项目一</li> <li>项目二</li> <li>项目三</li> </ul>\r\n<h2 class=\"article-subtitle\">子标题5</h2>\r\n<a href=\"https://example.com\" class=\"article-link\">示例链接</a>\r\n<img src=\"http://121.199.69.69:9091/assets/image/upload/img_688344f91f3c9_022ecfafdc.png\" alt=\"描述\" class=\"article-image\">\r\n<div class=\"article-video\"> <video controls> <source src=\"demo.mp4\" type=\"video/mp4\"> </video> </div>\r\n<div class=\"article-audio\"> <audio controls> <source src=\"audio.mp3\" type=\"audio/mpeg\"> </audio> </div>\r\n<h2 class=\"article-subtitle\">子标题6</h2>\r\n<table class=\"article-table\"> <thead> <tr> <th>标题1</th> <th>标题2</th> <th>标题3</th> </tr> </thead> <tbody> <tr> <td>内容1</td> <td>内容2</td> <td>内容3</td> </tr> <tr> <td>内容4</td> <td>内容5</td> <td>内容6</td> </tr> </tbody> </table>\r\n<h2 class=\"article-subtitle\">子标题7</h2>\r\n<pre class=\"article-code\"><code>\r\nfunction helloWorld() {\r\n    console.log(\"Hello, World!\");\r\n}\r\n</code></pre>\r\n<h2 class=\"article-subtitle\">子标题8</h2>\r\n<i class=\"fas fa-heart\"></i> 图标文本\r\n</article>', '1722791510', 7, '2025-07-25 18:19:01', 'https://p1.a.yximgs.com/upic/2025/07/25/21/BMjAyNTA3MjUyMTUxNThfMTU1NzAzMDAyNF8xNzA0ODQ1NjEyODVfMl82_Bb6ad421ca5fb8ce1b799ef311d12b062.jpg', '青和');

--
-- 转储表的索引
--

--
-- 表的索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- 表的索引 `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 限制导出的表
--

--
-- 限制表 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

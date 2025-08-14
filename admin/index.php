<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
include 'head.php';

// 获取仪表盘显示数据
$posts_count = $conn->query("SELECT COUNT(*) as count FROM posts")->fetch_assoc()['count'];
$comments_count = $conn->query("SELECT COUNT(*) as count FROM comments")->fetch_assoc()['count'];
$messages_count = $conn->query("SELECT COUNT(*) as count FROM message")->fetch_assoc()['count'];
?>
            <div class="page-header">
                <h1>仪表盘</h1>
            </div>
            
            <!-- 仪表盘数据统计卡片 -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $posts_count; ?></h3>
                        <p>文章总数</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $comments_count; ?></h3>
                        <p>评论总数</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $messages_count; ?></h3>
                        <p>留言总数</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>1</h3>
                        <p>管理员</p>
                    </div>
                </div>
            </div>
            
            <!-- 服务器信息 -->
            <div class="card">
                <div class="card-header">
                    <h2>服务器信息</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">服务器软件</span>
                                <span class="info-value"><?php echo $_SERVER['SERVER_SOFTWARE']; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">PHP版本</span>
                                <span class="info-value"><?php echo phpversion(); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">服务器IP</span>
                                <span class="info-value"><?php echo $_SERVER['SERVER_ADDR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">操作系统</span>
                                <span class="info-value"><?php echo php_uname('s'); ?> <?php echo php_uname('r'); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">最大内存限制</span>
                                <span class="info-value"><?php echo ini_get('memory_limit'); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">上传文件限制</span>
                                <span class="info-value"><?php echo ini_get('upload_max_filesize'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 开发者信息 -->
            <div class="card">
                <div class="card-body text-center"><center>
                    <h3>青和后台管理系统</h3>
                    <p>开发者: 青和 | QQ:1722791510 | 邮箱:admin@tsinho.cn<br>开发不易，请保留开发者信息</p>
                </center></div>
            </div>
            
            <style>
                .row {
                    display: flex;
                    flex-wrap: wrap;
                    margin: 0 -15px;
                }
                .col-md-6 {
                    width: 50%;
                    padding: 0 15px;
                }
                .info-item {
                    display: flex;
                    justify-content: space-between;
                    padding: 15px 0;
                    border-bottom: 1px solid #f1f4f9;
                }
                .info-label {
                    color: #7d8fa9;
                    font-weight: 500;
                }
                .info-value {
                    font-weight: 500;
                }
                @media (max-width: 768px) {
                    .col-md-6 {
                        width: 100%;
                    }
                }
            </style>
<?php include 'foot.php'; ?>

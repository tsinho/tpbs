<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
include 'head.php';

$post = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM posts WHERE id=$id");
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    }
}

// 保存文章
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $author = $conn->real_escape_string($_POST['author']);
    $author_qq = $conn->real_escape_string($_POST['author_qq']);
    $cover = $conn->real_escape_string($_POST['cover']);
    
    if ($post) {
        // 更新文章
        $sql = "UPDATE posts SET title='$title', content='$content', author='$author', author_qq='$author_qq', fm='$cover' WHERE id={$post['id']}";
    } else {
        // 新增文章
        $time = date('Y-m-d H:i:s');
        $sql = "INSERT INTO posts (title, content, author, author_qq, fm, time) 
                VALUES ('$title', '$content', '$author', '$author_qq', '$cover', '$time')";
    }
    
    if ($conn->query($sql)) {
        $message = $post ? '文章更新成功' : '文章发布成功';
        echo "<script>alert('$message'); window.location.href = 'posts.php';</script>";
        exit;
    } else {
        $error = "保存失败: " . $conn->error;
    }
}
?>
            <div class="page-header">
                <h1><?php echo $post ? '编辑文章' : '新建文章'; ?></h1>
                <div>
                    <a style="text-decoration:none" href="posts.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> 返回列表</a>
                </div>
            </div>
            
            <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>文章标题</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $post ? htmlspecialchars($post['title']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>文章内容（支持html代码）</label>
                            <div class="textarea-container">
                                <textarea name="content" id="content" class="form-control" rows="15" required><?php echo $post ? htmlspecialchars($post['content']) : ''; ?></textarea>
                                <div class="textarea-footer">
                                    <a target="_blank" href="demo.php"><small class="text-muted">博客文章美化指南</small></a>
                                    <small class="text-muted float-right">行数统计: <span id="wordCount">0</span></small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>作者昵称</label>
                                    <input type="text" name="author" class="form-control" value="<?php echo $post ? htmlspecialchars($post['author']) : '青和'; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>作者QQ</label>
                                    <input type="text" name="author_qq" class="form-control" value="<?php echo $post ? $post['author_qq'] : '1722791510'; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>文章封面</label>
                            <div class="d-flex align-items-center">
                                <div class="mr-3" id="coverPreview">
                                    <?php if($post && $post['fm']): ?>
                                    <img src="<?php echo htmlspecialchars($post['fm']); ?>" style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #e0e6ed;">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('coverUpload').click()">
                                        <i class="fas fa-upload"></i> 上传封面
                                    </button>
                                    <input type="file" id="coverUpload" style="display: none;" accept="image/*">
                                    <input type="hidden" name="cover" id="coverUrl" value="<?php echo $post ? htmlspecialchars($post['fm']) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> 保存文章
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <script>
                // 封面图片上传
                document.getElementById('coverUpload').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    
                    const formData = new FormData();
                    formData.append('file', file);
                    
                    fetch('upload.php', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const preview = document.getElementById('coverPreview');
                            preview.innerHTML = `<img src="${data.url}" style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #e0e6ed;">`;
                            document.getElementById('coverUrl').value = data.url;
                        } else {
                            alert('上传失败: ' + (data.message || '未知错误'));
                        }
                    })
                    .catch(error => {
                        console.error('上传出错:', error);
                        alert('上传出错: ' + error.message);
                    });
                });
                
                // 字数统计
                const contentTextarea = document.getElementById('content');
                const wordCountSpan = document.getElementById('wordCount');
                
                function updateWordCount() {
                    const text = contentTextarea.value;
                    // 简单统计 - 按非空白字符计算
                    const count = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
                    wordCountSpan.textContent = count;
                }
                
                contentTextarea.addEventListener('input', updateWordCount);
                updateWordCount(); // 初始化统计
            </script>
            
            <style>
                .textarea-container {
                    position: relative;
                }
                
                #content {
                    min-height: 400px;
                    padding: 15px;
                    line-height: 1.6;
                    font-size: 15px;
                    resize: vertical;
                    background: white;
                    border: 1px solid #e0e6ed;
                    border-radius: 8px;
                    transition: all 0.3s;
                }
                
                #content:focus {
                    border-color: #1a6df3;
                    outline: none;
                    box-shadow: 0 0 0 3px rgba(26, 109, 243, 0.15);
                }
                
                .textarea-footer {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 8px;
                    color: #7d8fa9;
                    font-size: 13px;
                }
                
                .alert {
                    padding: 12px 20px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    font-size: 15px;
                }
                
                .alert-danger {
                    background-color: rgba(239, 68, 68, 0.1);
                    border: 1px solid rgba(239, 68, 68, 0.2);
                    color: #b91c1c;
                }
            </style>
<?php include 'foot.php'; ?>
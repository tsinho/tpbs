<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
include 'head.php';
?>

<div class="page-header">
    <h1>图片上传</h1>
</div>

<div class="card">
    <div class="card-header">
        <h2>上传新图片</h2>
    </div>
    <div class="card-body">
        <div class="upload-container">
            <div class="upload-area" id="uploadArea">
                <i class="fas fa-cloud-upload-alt fa-3x"></i>
                <p>点击或拖拽文件到此处上传</p>
                <input type="file" id="fileInput" accept="image/*" style="display: none;">
            </div>
            
            <div class="upload-result mt-4" id="uploadResult" style="display: none;">
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> 图片上传成功！
                </div>
                
                <div class="preview-container">
                    <img id="imagePreview" class="img-thumbnail" style="max-height: 200px;">
                </div>
                
                <div class="url-container mt-3">
                    <label>图片URL：</label>
                    <div class="input-group">
                        <input type="text" id="imageUrl" class="form-control" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="copyBtn">
                                <i class="fas fa-copy"></i> 复制
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button class="btn btn-primary" id="uploadAnotherBtn">
                        <i class="fas fa-upload"></i> 上传另一张图片
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const uploadResult = document.getElementById('uploadResult');
    const imagePreview = document.getElementById('imagePreview');
    const imageUrl = document.getElementById('imageUrl');
    const copyBtn = document.getElementById('copyBtn');
    const uploadAnotherBtn = document.getElementById('uploadAnotherBtn');
    
    // 点击上传区域触发文件选择
    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });
    
    // 拖拽相关事件
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });
    
    uploadArea.addEventListener('dragleave', function() {
        uploadArea.classList.remove('dragover');
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            handleFileUpload();
        }
    });
    
    // 文件选择变化时处理上传
    fileInput.addEventListener('change', handleFileUpload);
    
    // 复制URL按钮
    copyBtn.addEventListener('click', function() {
        imageUrl.select();
        document.execCommand('copy');
        
        // 显示复制成功提示
        const originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check"></i> 已复制';
        
        setTimeout(function() {
            copyBtn.innerHTML = originalText;
        }, 2000);
    });
    
    // 上传另一张图片按钮
    uploadAnotherBtn.addEventListener('click', function() {
        uploadResult.style.display = 'none';
        uploadArea.style.display = 'flex';
        fileInput.value = '';
    });
    
    // 处理文件上传
    function handleFileUpload() {
        const file = fileInput.files[0];
        if (!file) return;
        
        // 验证文件类型
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('只支持 JPG, PNG, GIF 或 WebP 格式的图片');
            return;
        }
        
        // 验证文件大小 (最大5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('图片大小不能超过5MB');
            return;
        }
        
        // 显示加载状态
        uploadArea.innerHTML = '<i class="fas fa-spinner fa-spin fa-3x"></i><p>上传中...</p>';
        
        // 创建FormData对象
        const formData = new FormData();
        formData.append('file', file);
        
        // 发送AJAX请求
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
                // 显示上传结果
                uploadArea.style.display = 'none';
                uploadResult.style.display = 'block';
                
                // 显示预览和URL
                imagePreview.src = data.url;
                imageUrl.value = data.url;
            } else {
                // 上传失败，重置上传区域
                resetUploadArea();
                alert(data.message || '上传失败');
            }
        })
        .catch(error => {
            // 网络错误，重置上传区域
            resetUploadArea();
            alert('上传出错: ' + error.message);
        });
    }
    
    // 重置上传区域
    function resetUploadArea() {
        uploadArea.innerHTML = '<i class="fas fa-cloud-upload-alt fa-3x"></i><p>点击或拖拽文件到此处上传</p>';
        uploadArea.style.display = 'flex';
    }
});
</script>

<style>
.upload-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.upload-area {
    border: 2px dashed #e0e6ed;
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    background: #f8fafd;
}

.upload-area:hover {
    border-color: #1a6df3;
    background: rgba(26, 109, 243, 0.05);
}

.upload-area.dragover {
    border-color: #1a6df3;
    background: rgba(26, 109, 243, 0.1);
}

.upload-area i {
    color: #1a6df3;
    margin-bottom: 15px;
}

.upload-area p {
    color: #5a6a85;
    margin: 0;
    font-size: 16px;
}

.preview-container {
    text-align: center;
    margin: 20px 0;
}

.img-thumbnail {
    border: 1px solid #e0e6ed;
    border-radius: 8px;
    padding: 5px;
    background: white;
}

.url-container label {
    font-weight: 500;
    margin-bottom: 8px;
    display: block;
    color: #5a6a85;
}

.alert-success {
    background-color: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: #047857;
    padding: 12px 20px;
    border-radius: 8px;
}

.alert-success i {
    margin-right: 8px;
    color: #10b981;
}

@media (max-width: 768px) {
    .upload-area {
        padding: 30px 20px;
    }
}
</style>

<?php include 'foot.php'; ?>
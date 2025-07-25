<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
include 'head.php';


$result = $conn->query("SELECT * FROM config WHERE id=1");
$config = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $qq = $conn->real_escape_string($_POST['qq']);
    $wechat = $conn->real_escape_string($_POST['wechat']);
    $email = $conn->real_escape_string($_POST['email']);
    $place = $conn->real_escape_string($_POST['place']);
    $beian = $conn->real_escape_string($_POST['beian']);
    $yy_type = intval($_POST['yy_type']);
    $yy = $conn->real_escape_string($_POST['yy']);
    $wxpay = $conn->real_escape_string($_POST['wxpay']);
    $alipay = $conn->real_escape_string($_POST['alipay']);
    $lbt = $conn->real_escape_string($_POST['lbt']);
    
    $sql = "UPDATE config SET 
            name = '$name',
            qq = '$qq',
            wechat = '$wechat',
            email = '$email',
            place = '$place',
            beian = '$beian',
            yy_type = $yy_type,
            yy = '$yy',
            wxpay = '$wxpay',
            alipay = '$alipay',
            lbt = '$lbt'
            WHERE id=1";
    
    if ($conn->query($sql)) {
        $success = "系统配置已更新";
    } else {
        $error = "保存失败: " . $conn->error;
    }
}

if (isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    $result = $conn->query("SELECT password FROM config WHERE id=1");
    $row = $result->fetch_assoc();
    
    if (password_verify($old_password, $row['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $conn->query("UPDATE config SET password = '$hashed_password' WHERE id=1");
            $password_success = "密码修改成功";
        } else {
            $password_error = "两次输入的新密码不一致";
        }
    } else {
        $password_error = "旧密码不正确";
    }
}
?>
            <div class="page-header">
                <h1>系统设置</h1>
            </div>
            
            <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="card">
                    <div class="card-header">
                        <h2>基本设置</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>昵称</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($config['name']); ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>QQ</label>
                                    <input type="text" name="qq" class="form-control" value="<?php echo htmlspecialchars($config['qq']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>微信</label>
                                    <input type="text" name="wechat" class="form-control" value="<?php echo htmlspecialchars($config['wechat']); ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>邮箱</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($config['email']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>所在地</label>
                                    <input type="text" name="place" class="form-control" value="<?php echo htmlspecialchars($config['place']); ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>网站备案号</label>
                                    <input type="text" name="beian" class="form-control" value="<?php echo htmlspecialchars($config['beian']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>一言类型</label>
                                    <select name="yy_type" class="form-control">
                                        <option value="0" <?php echo $config['yy_type'] == 0 ? 'selected' : ''; ?>>多条随机展示</option>
                                        <option value="1" <?php echo $config['yy_type'] == 1 ? 'selected' : ''; ?>>单条固定展示</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>一言内容</label>
                            <textarea name="yy" class="form-control" rows="3"><?php echo htmlspecialchars($config['yy']); ?></textarea>
                            <small class="text-muted">当一言类型为单条时直接展示以上内容，当一言类型为多条时请用英文逗号分隔开每条。</small>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h2>支付设置</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>微信收款码</label>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3" id="wxpayPreview">
                                            <?php if($config['wxpay']): ?>
                                            <img src="<?php echo htmlspecialchars($config['wxpay']); ?>" alt="微信收款码" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #e0e6ed; border-radius: 8px;">
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('wxpayUpload').click()">
                                                <i class="fas fa-upload"></i> 更换二维码
                                            </button>
                                            <input type="file" id="wxpayUpload" style="display: none;" accept="image/*">
                                            <input type="hidden" name="wxpay" id="wxpayUrl" value="<?php echo htmlspecialchars($config['wxpay']); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>支付宝收款码</label>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3" id="alipayPreview">
                                            <?php if($config['alipay']): ?>
                                            <img src="<?php echo htmlspecialchars($config['alipay']); ?>" alt="支付宝收款码" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #e0e6ed; border-radius: 8px;">
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('alipayUpload').click()">
                                                <i class="fas fa-upload"></i> 更换二维码
                                            </button>
                                            <input type="file" id="alipayUpload" style="display: none;" accept="image/*">
                                            <input type="hidden" name="alipay" id="alipayUrl" value="<?php echo htmlspecialchars($config['alipay']); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h2>轮播图设置</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>轮播图配置</label>
                            <textarea name="lbt" class="form-control" rows="3"><?php echo htmlspecialchars($config['lbt']); ?></textarea>
                            <small class="text-muted">格式：图片直链1|跳转链接1,图片直链2|跳转链接2</small>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-save"></i> 保存所有设置
                    </button>
                </div>
            </form>
            <br>
            
            <form method="POST" class="mt-5">
                <div class="card">
                    <div class="card-header">
                        <h2>修改密码</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($password_success)): ?>
                        <div class="alert alert-success"><?php echo $password_success; ?></div>
                        <?php endif; ?>
                        
                        <?php if (isset($password_error)): ?>
                        <div class="alert alert-danger"><?php echo $password_error; ?></div>
                        <?php endif; ?>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>旧密码</label>
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>新密码</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>确认新密码</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" name="change_password" class="btn btn-primary px-5">修改密码</button>
                        </div>
                    </div>
                </div>
            </form>
            
            <script>
                // 微信收款码上传
                document.getElementById('wxpayUpload').addEventListener('change', function(e) {
                    uploadImage(e, 'wxpayPreview', 'wxpayUrl');
                });
                
                // 支付宝收款码上传
                document.getElementById('alipayUpload').addEventListener('change', function(e) {
                    uploadImage(e, 'alipayPreview', 'alipayUrl');
                });
                
                function uploadImage(e, previewId, urlId) {
                    const file = e.target.files[0];
                    if (!file) return;
                    
                    const formData = new FormData();
                    formData.append('file', file);
                    
                    fetch('upload.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const preview = document.getElementById(previewId);
                            preview.innerHTML = `<img src="${data.url}" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #e0e6ed; border-radius: 8px;">`;
                            document.getElementById(urlId).value = data.url;
                        } else {
                            alert('上传失败: ' + data.message);
                        }
                    })
                    .catch(() => {
                        alert('网络错误');
                    });
                }
            </script>
            
            <style>
                .alert {
                    padding: 15px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                }
                .alert-success {
                    background: rgba(16, 185, 129, 0.1);
                    border: 1px solid rgba(16, 185, 129, 0.3);
                    color: #047857;
                }
                .alert-danger {
                    background: rgba(239, 68, 68, 0.1);
                    border: 1px solid rgba(239, 68, 68, 0.3);
                    color: #b91c1c;
                }
            </style>
<?php include 'foot.php'; ?>
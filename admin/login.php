<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
session_start();
define('IN_APP', true);
require_once '../config/database.php';

// 验证码生成
if (isset($_GET['action']) && $_GET['action'] == 'captcha') {
    header('Content-type: image/png');
    $im = imagecreatetruecolor(120, 40);
    $bg = imagecolorallocate($im, 255, 255, 255);
    imagefill($im, 0, 0, $bg);
    $text_color = imagecolorallocate($im, 26, 109, 243); 
    
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
    $captcha = '';
    for ($i = 0; $i < 4; $i++) {
        $captcha .= $chars[rand(0, strlen($chars) - 1)];
    }
    
    $_SESSION['captcha'] = $captcha;
    
    // 扭曲效果
    for ($i = 0; $i < 120; $i++) {
        for ($j = 0; $j < 40; $j++) {
            $rgb = imagecolorat($im, $i, $j);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $new_x = $i + sin($j / 10) * 3;
            if ($new_x < 0 || $new_x >= 120) continue;
            imagesetpixel($im, $new_x, $j, imagecolorallocate($im, $r, $g, $b));
        }
    }
    
    // 添加干扰线
    for ($i = 0; $i < 5; $i++) {
        $color = imagecolorallocate($im, rand(0, 150), rand(0, 150), rand(0, 150));
        imageline($im, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $color);
    }
    
    // 绘制文字
    $font = 5;
    $x = 20;
    for ($i = 0; $i < 4; $i++) {
        $angle = rand(-15, 15);
        imagettftext($im, 20, $angle, $x, 30, $text_color, __DIR__.'/../assets/font/arial.ttf', $captcha[$i]);
        $x += 25;
    }
    
    imagepng($im);
    imagedestroy($im);
    exit;
}

// 登录表单处理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);
    $captcha = trim($_POST['captcha']);
    
    // 验证验证码
    if (empty($_SESSION['captcha']) || strtolower($captcha) !== strtolower($_SESSION['captcha'])) {
        $error = "验证码错误";
    } else {
        unset($_SESSION['captcha']);
        
        // 获取管理员信息
        $result = $conn->query("SELECT admin, password FROM config WHERE id=1");
        if ($result->num_rows == 0) {
            $error = "系统配置错误";
        } else {
            $row = $result->fetch_assoc();
            
            // 验证用户名
            if ($user !== $row['admin']) {
                $error = "用户名错误";
            } else {
                // 验证密码
                if (password_verify($password, $row['password'])) {
                    // 生成cookie
                    $cookie_value = bin2hex(random_bytes(32));
                    $expire = time() + 86400; // 1天
                    setcookie('tpbs', $cookie_value, $expire, '/');
                    
                    // 更新数据库
                    $conn->query("UPDATE config SET cookie='$cookie_value' WHERE id=1");
                    
                    // 跳转到后台
                    header('Location: index.php');
                    exit;
                } else {
                    $error = "密码错误";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/icon.php';?>
    <title>登录 - 青和后台管理系统</title>
    <link rel="stylesheet" href="../assets/css/fontawesome/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Microsoft YaHei', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #1a6df3 0%, #0d5bda 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-container {
            margin:50px 0 0 0;
            background: white;
            width: 100%;
            max-width: 450px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: translateY(-5%);
        }
        .login-header {
            background: #1a6df3;
            color: white;
            text-align: center;
            padding: 35px 20px;
            position: relative;
            overflow: hidden;
        }
        .login-header::before {
            content: "";
            position: absolute;
            top: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .login-header::after {
            content: "";
            position: absolute;
            bottom: -80px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .login-header h1 {
            font-size: 28px;
            font-weight: 600;
            position: relative;
            z-index: 2;
        }
        .login-header p {
            margin-top: 8px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }
        .login-body {
            padding: 35px 40px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: #333;
            font-size: 15px;
        }
        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #e0e6ed;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f9fbfd;
        }
        .form-control:focus {
            border-color: #1a6df3;
            outline: none;
            box-shadow: 0 0 0 3px rgba(26, 109, 243, 0.15);
            background: white;
        }
        .captcha-container {
            display: flex;
            gap: 12px;
        }
        .captcha-container input {
            flex: 1;
        }
        .captcha-img {
            border: 1px solid #e0e6ed;
            border-radius: 8px;
            cursor: pointer;
            height: 52px;
            background: #f9fbfd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
            color: #1a6df3;
            letter-spacing: 2px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: #1a6df3;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(26, 109, 243, 0.3);
        }
        .btn:hover {
            background: #0d5bda;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(26, 109, 243, 0.4);
        }
        .error {
            color: #ff4757;
            text-align: center;
            margin-bottom: 20px;
            font-size: 15px;
            padding: 12px;
            background: rgba(255, 71, 87, 0.1);
            border-radius: 8px;
        }
        .copyright {
            text-align: center;
            margin-top: 30px;
            color: #7d8fa9;
            font-size: 14px;
            line-height: 1.6;
        }
        @media (max-width: 480px) {
            .login-container {
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            }
            .login-body {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>青和后台管理系统</h1>
        </div>
        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="user">用户名</label>
                    <input type="text" id="user" name="user" class="form-control" required value="<?php echo isset($user) ? htmlspecialchars($user) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="captcha">验证码</label>
                    <div class="captcha-container">
                        <input type="text" id="captcha" name="captcha" class="form-control" required maxlength="4">
                        <img src="login.php?action=captcha" alt="验证码" class="captcha-img" onclick="this.src='login.php?action=captcha&t='+Math.random()">
                    </div>
                </div>
                <button type="submit" class="btn">登 录</button>
            </form>
            <div class="copyright">
                青和后台管理系统 &copy; <?php echo date('Y'); ?> <br>青和 | QQ:1722791510 | 邮箱:admin@tsinho.cn
            </div>
        </div>
    </div>
</body>
</html>

# TPBS (Tsinho Personal Blog System) 青和个人博客系统

![Version](https://img.shields.io/badge/Version-1.0-blue) 
![License](https://img.shields.io/badge/License-GPLv3.0-green)
![PHP](https://img.shields.io/badge/PHP-7.0+-purple)
![MySQL](https://img.shields.io/badge/MySQL-5.6+-blue)

TPBS（青和个人博客系统）是一个轻量级个人博客系统，采用PHP+MySQL开发，适合快速搭建个人博客网站。

## 📦 安装部署

### 环境要求
- PHP 7.0+
- MySQL 5.6+
- Apache/Nginx

### 安装步骤
1. 下载源码压缩包并上传至网站根目录
2. 解压源码包
3. 导入数据库文件（`tpbs.sql`）到MySQL
4. 配置数据库连接（编辑`/config/database.php`）
5. 安装完成！

## 🔑 后台管理
- 访问地址：`你的域名/admin`
- 默认账号：`admin`
- 默认密码：`123456`（请及时修改）

## ⚙️ 配置文件
主要配置文件位于：
- `/config/database.php` - 数据库配置

## 📝 使用说明
1. 本系统为开源项目，允许二次开发
2. 二次修改需保留原作者信息
3. 禁止用于商业倒卖
4. 系统可能存在安全漏洞，使用需谨慎

## 🛠️ 二次开发说明
①源码内的数据库配置文件（根目录/config/database.php）与根目录/includes/目录下所有文件均添加了访问限制，如在二改过程中需引用这些模块文件需在代码中加入define('IN_APP', true);定义当前处于应用内环境。
②后台管理员账户密码使用bcrypt加密方式加密。


<img width="1900" height="917" alt="登录" src="https://github.com/user-attachments/assets/2e05a072-835c-4dcf-9666-3ec16eef6e8f" />
<img width="1900" height="919" alt="评论管理" src="https://github.com/user-attachments/assets/1a1f0a28-56ab-4867-afd4-26292fe6ea46" />
<img width="1899" height="913" alt="图片上传" src="https://github.com/user-attachments/assets/bf992f39-5648-4e09-a92c-81a4109c25d6" />
<img width="1901" height="918" alt="文章管理" src="https://github.com/user-attachments/assets/d31d4c08-5f22-4b16-adf2-8c3240935fc1" />
<img width="1879" height="914" alt="系统设置" src="https://github.com/user-attachments/assets/08410483-078d-4fd7-ab59-15c3f35eeccc" />
<img width="1879" height="920" alt="仪表盘" src="https://github.com/user-attachments/assets/a046dc44-a295-45f7-a7e3-1bdbd784a179" />
![博客](https://github.com/user-attachments/assets/7d2cfdf2-f0a3-4697-b7a1-d4c82cc47e74)
![捐赠](https://github.com/user-attachments/assets/f06e317b-6951-4994-afa0-75c055cf90d8)
![留言](https://github.com/user-attachments/assets/477d6f6e-73cc-493f-b639-df63b2ef4128)
![首页](https://github.com/user-attachments/assets/2b56127c-9ce8-490c-82f5-aa9a4df2d459)
![文章](https://github.com/user-attachments/assets/715b7764-ff99-4d46-835d-227eaf466571)

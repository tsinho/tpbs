# TPBS (Tsinho Personal Blog System) 青和个人博客系统

![Version](https://img.shields.io/badge/Version-1.0-blue) 
![License](https://img.shields.io/badge/License-MIT-green)
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

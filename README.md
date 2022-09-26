# NewsCms

### 项目介绍
基于php Laravel 和 Bootstrap开发的内容管理系统，兼容适配移动端

### 环境
- PHP version > 7.0
- Apache，Nginx或者其他web服务器
- Composer

### 部署方法
- `git clone https://github.com/waahah/NewsCms.git`

- `cd projectname`

- `composer install`

- copy *.env.example* to *.env*

- 更改.env里面`DB_CONNECTION`,`DB_DATABASE`,`DB_USERNAME`,`DB_PASSWORD`等数据库配置

- ~~`php artisan migrate --seed`创建和填充表~~

- 创建数据库`cms`.在.env文件中`DB_DATABASE`选项中可更改

- 执行命令生成管理员账号哈希加密密码
  ```php
  php artisan db:seed --class=AdminuserTableSeeder
  ```

- `php artisan serve`以在 http://localhost:8000/ 上启动应用程序

### 测试
你可以使用`PHPUnit`单元测试API
- 管理员账号:admin/123456
- 普通账号:test/123456

### 图片演示

<img src="https://user-images.githubusercontent.com/90046731/170527209-eafbd3c8-63a5-4a90-8dfa-084cadaec84b.png" width="30%">

<img src="https://user-images.githubusercontent.com/90046731/170527477-cea1688d-158d-4c1c-939b-28fd97b00019.png" width="40%">

<img src="https://user-images.githubusercontent.com/90046731/170526670-73337c75-5420-4f22-983b-33cb01fd4051.png" width="30%">

NewCms based on laravel development of an information management system, suitable for beginners to practice. 

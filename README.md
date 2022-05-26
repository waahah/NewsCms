# NewsCms

### 项目介绍
基于php Laravel和Bootstrap开发的内容管理系统，兼容适配移动端

### 部署方法
- 创建数据库`cms`.在.env文件中`DB_DATABASE`选项中可更改

- 更改.env里面`DB_USERNAME`,`DB_PASSWORD`等数据库配置

- 执行命令生成管理员账号哈希加密密码
```cmd
php artisan db:seed --class=AdminuserTableSeeder
```

- 管理员账号:admin/123456
- 普通账号:test/123456

### 图片演示

<img src="https://user-images.githubusercontent.com/90046731/170527209-eafbd3c8-63a5-4a90-8dfa-084cadaec84b.png" width="30%">

<img src="https://user-images.githubusercontent.com/90046731/170527477-cea1688d-158d-4c1c-939b-28fd97b00019.png" width="40%">

<img src="https://user-images.githubusercontent.com/90046731/170526670-73337c75-5420-4f22-983b-33cb01fd4051.png" width="30%">

NewCms based on laravel development of an information management system, suitable for beginners to practice. 

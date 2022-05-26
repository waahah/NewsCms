<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 引入静态文件 -->
  <link rel="stylesheet" href="{{asset('admin')}}/common/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/common/font-awesome-4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/common/toastr.js/2.1.4/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/css/main.css">
  <script src="{{asset('admin')}}/common/jquery/1.12.4/jquery.min.js"></script>
  <script src="{{asset('admin')}}/common/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="{{asset('admin')}}/common/toastr.js/2.1.4/toastr.min.js"></script>
  <script src="{{asset('admin')}}/js/main.js"></script>
  <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light main-navbar">
  <a class="navbar-brand" href="#">后台管理系统</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- 左侧导航栏 -->
    <div class="main-sidebar">
      <ul class="nav flex-column main-menu">
        <!-- 首页 -->
        <li class="">
          <a href="{{ url('admin/index') }}" class="active">
            <i class="fa fa-home fa-fw"></i>首页
          </a>
        </li>
        <!-- 栏目 -->
        <li class="main-sidebar-collapse">
          <a href="#" class="main-sidebar-collapse-btn">
              <i class="fa fa-list-alt fa-fw"></i>栏目
              <span class="fa main-sidebar-arrow"></span>
          </a>
          <ul class="nav">
            <li>
              <a href="{{ url('category/add') }}" data-name="addcategory"><i class="fa fa-list fa-fw"></i>添加</a>
            </li>
            <li>
              <a href="{{ url('category') }}" data-name="category"><i class="fa fa-table fa-fw"></i>列表</a>
            </li>
          </ul>
        </li>
        <!-- 内容 -->
        <li class="main-sidebar-collapse">
          <a href="#" class="main-sidebar-collapse-btn">
            <i class="fa fa-list-alt fa-fw"></i>内容
            <span class="fa main-sidebar-arrow"></span>
          </a>
          <ul class="nav">
            <li>
              <a href="{{ url('content/add') }}" data-name="addcontent">
              <i class="fa fa-list fa-fw"></i>添加</a>
            </li>
            <li>
              <a href="{{ url('content') }}" data-name="content">
                <i class="fa fa-table fa-fw"></i>列表</a>
            </li>
          </ul>
        </li>
        <!-- 广告 -->
        <li class="main-sidebar-collapse">
          <a href="#" class="main-sidebar-collapse-btn">
            <i class="fa fa-cog fa-fw"></i>广告
            <span class="fa main-sidebar-arrow"></span>
          </a>
          <ul class="nav">
            <li>
              <a href="{{ url('adv') }}" data-name="adv">
                <i class="fa fa-list fa-fw"></i>广告位</a>
            </li>
            <li>
              <a href="{{ url('advcontent') }}" data-name="advcontent">
                <i class="fa fa-list-alt fa-fw"></i>广告内容</a>
           </li>
          </ul>
        </li>
      </ul>
    </div>
    <ul class="nav ml-auto main-nav-right">
      <li>
        <a href="#" class="j-layout-pwd">
          <i class="fa fa-user fa-fw"></i>{{ session()->get('user.name') }}
        </a>
      </li>
      <li>
        <a href="{{ url('admin/logout') }}">
          <i class="fa fa-power-off fa-fw"></i>退出
        </a>
      </li>
    </ul>
  </div>
</nav>
<div class="main-container">
  <div class="main-content">
    <div>@yield('main')</div>
  </div>
</div>

@if(!empty(session('message')))　
<div class="alert alert-success" role="alert"
    style="text-align:center;margin:0 auto;width: 400px">
  {{session('message')}}
</div>
@endif
@if(!empty(session('tip')))　
<div class="alert alert-warning" role="alert"
    style="text-align:center;margin:0 auto;width: 400px">
  {{session('tip')}}
</div>
@endif
@if ($errors->any())
  <div class="alert alert-warning">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<script>
  main.layout();
  setInterval(function(){
    $('.alert').remove();
  },3000);
</script>

</body>
</html>

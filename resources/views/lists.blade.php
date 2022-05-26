<!DOCTYPE html>
<html>
<head>
  @include('public/static')
  <title>列表页</title>
</head>
<body>
@include('public/header')
<div class="main">
  <div class="main-crumb">
    <div class="container">
      <!-- 面包屑导航 -->
      <nav aria-label="breadcrumb">
        {!! Breadcrumbs::render('category', $id); !!}
      </nav>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <!-- 内容列表 -->
          @foreach($content as $con)
          <div class="col-md-6 mb-4">
            <div class="card main-card">
              <div class="main-card-pic">
                <a href="{{ url('detail', ['id' => $con->id ])}}">
                  <img class="img-fluid" src="@if($con->image)/static/upload/{{$con->image}}@else {{asset('admin')}}/img/noimg.png @endif">
                  <span><i class="fa fa-search"></i></span>
                </a>
              </div>
              <div class="card-body">
                <div class="main-card-info">
                  <span><i class="fa fa-calendar"></i>{{ date('Y-m-d', strtotime($con->created_at)) }}</span>
                  <span><i class="fa fa-comments"></i>{{$con->comments->count()}}</span>
                </div>
                <h3><a href="{{ url('detail', ['id' => $con->id ])}}">{{$con->title}}</a></h3>
                <div class="main-card-desc">{{str_limit(strip_tags($con->content),100)}}</div>
              </div>
              <a href="{{ url('detail', ['id' => $con->id ])}}" class="main-card-btn">阅读更多</a>
            </div>
          </div>
          @endforeach
        </div>
        {{ $content->links()}}
      </div>
      <div class="col-md-3">
        <!-- 侧边栏 -->
        @include('public/sidebar')
      </div>
    </div>
  </div>
</div>
@include('public/footer')
</body>
</html>

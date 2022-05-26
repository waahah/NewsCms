<!DOCTYPE html>
<html>
<head>
  @include('public/static')
  <title>首页</title>
</head>
<body>
@include('public/header')
<div class="main">
  <div class="container">
    <div class="row mt-4">
      <!-- 轮播图 -->
      <div class="col-md-6 main-carousel">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($recommend as $k=>$con)
              <div class="carousel-item @if($k==0) active @endif">
                <img src="/static/upload/{{$con->image}}" class="d-block w-100">
                <a href="{{url('detail', ['id'=> $con->id])}}">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>{{$con->title}}</h5>
                    <p></p>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <!-- 广告位 -->
      <div class="col-md-6">
        <div class="row main-imgbox">
          @foreach($adv as $adval)
            <div class="col-md-6">
              <a href="#"><img class="img-fluid" src="/static/upload/{{$adval}}"></a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <!-- 栏目内容 -->
          @foreach($list as $value)
          <div class="col-md-6 mb-4">
            <div class="card main-card">
              <div class="card-header">
                <h2>{{$value->name}}</h2>
                <span class="float-right">
                  <a href="{{ url('lists', ['id' => $value->id ])}}">[ 查看更多 ]</a>
                </span>
              </div>
              @foreach($value->content as $val)
              <div class="card-body">
                <div class="main-card-pic">
                  <a href="{{url('detail', ['id'=> $val->id])}}">
                    <img class="img-fluid" src="/static/upload/{{$val->image}}">
                    <span><i class="fa fa-search"></i></span>
                  </a>
                </div>
                <div class="main-card-info">
                  <span><i class="fa fa-calendar"></i>
                  {{ date('Y-m-d', strtotime($val->created_at)) }}</span>
                </div>
                <h3><a href="{{url('detail', ['id'=> $val->id])}}">{{$val->title}}</a></h3>
                <div class="main-card-desc">{!!str_limit($val->content , 100)!!}</div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
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

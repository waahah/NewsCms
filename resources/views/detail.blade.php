<!DOCTYPE html>
<html>
<head>
  @include('public/static')
  <title>详细页</title>
</head>
<body>
@include('public/header')
<div class="main">
  <div class="main-crumb">
    <div class="container">
      <!-- 面包屑导航 -->
      <nav aria-label="breadcrumb">
        {!! Breadcrumbs::render('detail', ['id'=>$id,'cid'=>$cid]); !!}
      </nav>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <!-- 内容区域 -->
        <article class="main-article">
          <header>
            <h1>{{$content->title}}</h1>
            <div>发表于{{ date('Y-m-d', strtotime($content->create_time)) }}</div>
          </header>
          <div class="main-article-content">
            <p><img class="img-fluid" src="/static/upload/{{$content->image}}"></p>
            <p>{!! $content->content !!}</p>
          </div>
          <!-- 点赞模块 -->
          @if(session()->has('users'))
            <div class="main-article-like">
              <span>
              <i class="fa fa-thumbs-up" aria-hidden="true">{{$count}}</i>
              </span>
            </div>
          @endif
        </article>
        <div class="main-comment">
          <!-- 评论列表 -->
          @if(!$comments->isEmpty())
            <div class="main-comment-header">
              <span id="count">{{$comments->count()}}</span> 条评论
            </div>
            @foreach($comments as $val)
              <div class="main-comment-item">
                <div class="main-comment-name">{{$val->user->name}}</div>
                <div class="main-comment-date">
                  {{ date('Y-m-d', strtotime($val->created_at)) }}</div>
                <div class="main-comment-content">{{$val->content}}</div>
              </div>
            @endforeach
          @endif
        </div>
        <!-- 发表评论模块 -->
        <div class="main-reply">
          @if(session()->has('users'))
            <div class="main-reply-header">发表评论</div>
            <div class="main-reply-title">评论内容</div>
            <div><textarea name="content" rows="8" id="content"></textarea></div>
            <div>
              <input type="hidden" id='c_id' value="{{$id}}">
              <input type="button" value="提交评论" id="publish">
            </div>
          @endif
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
<script>
  $(document).ready(function() {
    $(".fa-thumbs-up").bind("click", function () {
      $.get("{{ url('like', $id) }}", {}, function (result) {
        var count = result.count;
        $(".fa-thumbs-up").html();
        $(".fa-thumbs-up").html(count);
      });
    });

    $('#publish').bind("click",function(){
      var data = {
        'cid' : $("#c_id").val(),
        'content' : $("#content").val()
      };
      $.get("{{ url('comment') }}",data, function(result){
        var data = result.data;
        var user = data.user;
        var html = '<div class="main-comment-item">';
        html += '<div class="main-comment-name">' + user['name'] + '</div>';
        html += '<div class="main-comment-date">';
        html += data['created_time'];
        html += '</div>';
        html += '<div class="main-comment-content">';
        html += data['content'] + '</div>';
        html += '</div>';
        $(".main-comment").append(html);
        $("#count").html();
        $("#count").html(data['count']);
      });
    });
  });
</script>
</html>

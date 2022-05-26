<div class="card main-card main-card-sidebar">
  <div class="card-header"><h2>热门内容</h2></div>
  @foreach($hotContent as $val)
    <div class="card-body">
      <div class="main-card-pic">
        <a href="{{url('detail', ['id' => $val->content->id])}}">
          <img class="img-fluid" src="/static/upload/{{$val->content->image}}">
          <span><i class="fa fa-search"></i></span>
        </a>
      </div>
      <h3><a href="{{url('detail', ['id' => $val->content->id])}}">{{$val->content->title}}</a></h3>
    </div>
  @endforeach
</div>

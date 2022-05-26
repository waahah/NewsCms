@extends('admin/layouts/admin')
@section('title', '内容列表')
@section('main')
  <div class="main-title"><h2>内容管理</h2></div>
  <div class="main-section form-inline">
    <a href="{{ url('content/add') }}" class="btn btn-success">+ 新增</a>
    <!-- 此处编写分类下拉菜单 -->
    <select class="j-select form-control" style="min-width:120px;margin-left:8px">
      <option value="{{ url('content', ['id' => 0]) }}">所有分类</option>
      @foreach($category as $v)
        @if($v['level'])
        <option value="{{ url('content', ['d' => $v['id']]) }}" data-id="{{$v['id']}}">
          <small class="text-muted">--</small> {{$v['name']}}
        </option>
        @else
        <option value="{{ url('content', ['id' => $v['id']]) }}" data-id="{{$v['id']}}">
          {{$v['name']}}
        </option>
        @endif
      @endforeach
    </select>
  </div>
  <div class="main-section">
    <form method="post" action="{{ url('category/sort')}}" class="j-form">
      <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
          <th width="75">序号</th><th>分类</th><th>图片</th><th>标题</th>
          <th>状态</th><th>创建时间</th><th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($content as $v)
          <!-- 此处编写内容列表代码 -->
          <tr class="j-pid-{{ $v->pid }}" @if($v->level)style="display:none"@endif>
            <td>{{ $v->id }}</td>
            <td>{{ $v->category->name}}</td>
            <td><img @if($v->image) src="/static/upload/{{ $v->image}}" @else src="{{asset('admin')}}/img/noimg.png" @endif width="50" height="50"></td>
            <td>{{ $v->title }}</td>
            <td>@if($v->status==1) 默认  @else 推荐 @endif</td>
            <td>{{ $v->created_at }}</td>
            <td><a href="{{ url('content/edit', ['id' => $v->id ]) }}" style="margin-right:5px;">编辑</a>
              <a href="{{ url('content/delete', ['id' => $v->id ]) }}" class="j-del text-danger">删除</a>
            </td>
          </tr>
        @endforeach
        @if(empty($content))
          <tr><td colspan="7" class="text-center">还没有添加内容</td></tr>
        @endif
        </tbody>
      </table>
      {{csrf_field()}}
    </form>
  </div>
  <script>
    main.menuActive('content');
    $('.j-select').change(function() {
      location.href = $(this).val();
    });
    $('option[data-id=' + {{$cid}} + ']').attr('selected', true);
    $('.j-del').click(function() {
      if (confirm('您确定要删除此项？')) {
        var data = { _token: '{{ csrf_token() }}' };
        main.ajaxPost({url:$(this).attr('href'), data: data}, function(){
          location.reload();
        });
      }
      return false;
    });
  </script>
@endsection

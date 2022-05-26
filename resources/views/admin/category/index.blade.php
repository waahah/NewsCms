@extends('admin/layouts/admin')
@section('title', '栏目列表')
@section('main')
<div class="main-title"><h2>栏目管理</h2></div>
<div class="main-section form-inline">
  <a href="{{ url('category/add') }}" class="btn btn-success">+ 新增</a>
</div>
<div class="main-section">
  <form method="post" action="{{ url('category/sort')}}" class="j-form">
    <table class="table table-striped table-bordered table-hover">
      <thead>
      <tr>
        <th width="75">序号</th><th>名称</th><th width="100">操作</th>
      </tr>
      </thead>
      <tbody>
      <!-- 栏目列表 -->
      @foreach($category as $v)
        <tr class="j-pid-{{ $v['pid'] }}"
          @if($v['level'])style="display:none"@endif>
          <td><input type="text" class="form-control j-sort" maxlength="5" value="{{$v['sort']}}" data-name="sort[{{$v['id']}}]" style="height:25px;font-size:12px;padding:0 5px;"></td>
          <td>
            @if($v['level'])
              <small class="text-muted">├──</small> {{$v['name']}}
            @else
              <a href="#" class="j-toggle" data-id="{{$v['id']}}">
                @if(!$v['isLeaf'])
                  <i class="fa fa-plus-square-o fa-minus-square-o fa-fw"></i>
                @endif
                {{$v['name']}}
              </a>
            @endif
          </td>
          <td>
            <a href="{{ url('category/edit', ['id' => $v['id']]) }}" style="margin-right:5px;">编辑</a>
            <a href="{{ url('category/delete', ['id' => $v['id']]) }}" class="j-del text-danger">删除</a>
          </td>
        </tr>
      @endforeach
      @if(empty($category))
        <tr><td colspan="4" class="text-center">还没有添加分类</td></tr>
      @endif
      </tbody>
    </table>
    {{csrf_field()}}
    <input type="submit" value="改变排序" class="btn btn-primary">
  </form>
</div>
<script>
  main.menuActive('category');
  $('.j-toggle').click(function() {
    var id = $(this).attr('data-id');
    $(this).find('i').toggleClass('fa-plus-square-o');
    $('.j-pid-' + id).toggle();
    return false;
  });
  $('.j-sort').change(function() {
    $(this).attr('name', $(this).attr('data-name'));
  });
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

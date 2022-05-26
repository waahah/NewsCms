@extends('admin/layouts/admin')
@section('title', '栏目列表')
@section('main')
<div class="main-title"><h2>编辑分类</h2></div>
<div class="main-section">
  <div style="width:543px">
    <!-- 编辑表单 -->
    <form method="post" action="{{ url('/category/save') }}">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">序号</label>
        <div class="col-sm-10">
          <input type="number" name="sort" class="form-control" value="{{$data->sort}}" style="width:80px;">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">上级分类</label>
        <div class="col-sm-10">
          <select name="pid" class="form-control" style="width:200px;">
            <option value="0">---</option>
            @foreach($category as $v)
              <option value="{{ $v->id }}" @if($data['pid'] == $v['id']) selected @endif> {{ $v->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">名称</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" value="{{$data->name}}" style="width:200px;">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{$id}}">
          <button type="submit" class="btn btn-primary mr-2">提交表单</button>
          <a href="{{url('category')}}" class="btn btn-secondary">返回列表</a>
          {{--<a href="{{url('category')}}">--}}
            {{--<button class="btn btn-secondary">返回列表</button>--}}
          {{--</a>--}}
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  main.menuActive('category');
</script>
@endsection

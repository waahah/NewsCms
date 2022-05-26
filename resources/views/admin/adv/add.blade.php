@extends('admin/layouts/admin')
@section('title', '广告位')
@section('main')
<div class="main-title"><h2>添加广告位</h2></div>
<div class="main-section">
  <div style="width:543px">
    <form method="post" action="{{ url('/adv/save') }}">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">广告位名称</label>
        <div class="col-sm-9">
          <input type="text" name="name"  @if(isset($data['name'])) value="{{$data->name}}" @endif class="form-control" style="width:200px;">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          {{csrf_field()}}
          @if(isset($data['id'])) <input type="hidden" name="id" value="{{$data->id}}"> @endif
          <button type="submit" class="btn btn-primary mr-2">提交表单</button>
          <a href="{{ url('adv') }}" class="btn btn-secondary">返回列表</a>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
main.menuActive('adv');
</script>
@endsection

@extends('admin/layouts/admin')
@section('title', '添加广告')
@section('main')
<div class="main-title"><h2><div class="main-title"><h2>@if(!empty($data))编辑@else添加@endif广告</h2></div>
<div class="main-section">
  <div style="width:543px">
    <form method="post" action="{{ url('/advcontent/save') }}">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">选择广告位</label>
        <div class="col-sm-9">
          <!-- 广告位列表 -->
          <select name="advid" class="form-control" style="width:200px;">
            @foreach ($position as $v)
            <option value="{{ $v->id }}" @if(isset($data->advposid) && $data->advposid == $v->id) selected @endif>
              {{ $v->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">上传图片</label>
        <div class="col-sm-9">
          <input type="file" id="file1" name="path" value="上传图片">
        </div>
        <div class="col-sm-9 offset-sm-3">
          <div class="upload-img-box" id="uploadImg">
            @if(isset($data->path))
            <div class="upload-pre-item" style="max-height:100%;">
                @foreach ($data->path as $val)
                <img src="/static/upload/{{$val}}"
                    style="width:100px;height:100px"/>
                <input type="hidden" name="path[]" value="{{$val}}"
                        class="icon_banner"/>
                @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-9">
          {{csrf_field()}}
          @if(isset($data['id'])) <input type="hidden" name="id" value="{{$data->id}}"> @endif
          <button type="submit" class="btn btn-primary mr-2">提交表单</button>
          <a href="{{ url('advcontent') }}" class="btn btn-secondary">返回列表</a>
        </div>
      </div>
    </form>
  </div>
</div>
<link href="{{asset('admin')}}/common/uploader/uploadifive.css" rel="stylesheet" />
<script src="{{asset('admin')}}/common/uploader/jquery.uploadifive.js"></script>
<script>
main.menuActive('advcontent');
$(function(){
  $('#file1').uploadifive({
    'auto'       : true,
    'fileObjName'    : 'image',
    'fileType'     : 'image',
    'buttonText'     : '上传图片',
    'formData'     : { '_token' : "{{ csrf_token() }}" },
    'method'       : 'post',
    'queueID'      : 'uploadImg',
    'removeCompleted'  : true,
    'uploadScript'   : '{{ url('advcontent/upload')}}',
    'onUploadComplete' : uploadPicture_icon
  });
});
function uploadPicture_icon(file, data) {
  var obj = $.parseJSON(data);
  var src = '';
  if (obj.code) {
    filename = obj.data.filename;
    path = obj.data.path;
    if ($('.upload-pre-item').length > 0) {
        $('.upload-pre-item').append(
            '<img src="' + path + '" style="width:100px;height:100px"/> <input type="hidden" name="path[]" value="'+filename+'" class="icon_banner"/>'
        );
    } else {
      $('.upload-img-box').append(
        '<div class="upload-pre-item" style="max-height:100%;"><img src="' + path + '" style="width:100px;height:100px"/> <input type="hidden" name="path[]" value="'+filename+'" class="icon_banner"/></div>'
      );
    }
  } else {
    alert(data.info);
  }
}
</script>
@endsection

@extends('admin/layouts/admin')
@section('title', '添加内容')
@section('main')
<div class="main-title"><h2>添加内容</h2></div>
<div class="main-section">
  <div style="width:80%">
    <!-- 添加内容表单 -->
    <form method="post" action="{{ url('/content/save') }}" class="j-form">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">所属分类</label>
        <div class="col-sm-10">
          <select name="cid" class="form-control" style="width:200px;">
            <!-- 分类下拉列表 -->
            @foreach($category as $v)
              @if($v['level'])
                <option value="{{$v['id']}}">
                  <small class="text-muted">├──</small>{{$v['name']}}
                </option>
              @else
                <option value="{{$v['id']}}"> {{$v['name']}}</option>
              @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">标题</label>
        <div class="col-sm-10">
          <input type="text" name="title" class="form-control" style="width:200px;">
        </div>
      </div>
      <!-- 上传图片按钮 -->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">图片</label>
        <div class="col-sm-10">
          <input type="file" id="file1" name="image" value="上传图片" multiple="true">
        </div>
        <div class="col-sm-10 offset-sm-2">
          <div class="upload-img-box" id="uploadImg"></div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">简介</label>
        <div class="col-sm-10">
          <!-- <textarea class="j-goods-content" name="content" style="height:500px"></textarea> -->
          <script type="text/plain" class="j-goods-content" name="content" style="height:500px"></script>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">状态</label>
        <div class="col-sm-10">
          <div class="form-check form-check-inline" style="height:38px">
            <input class="form-check-input" id="inlineRadio1" type="radio" name="status" value="1" checked>
            <label class="form-check-label" for="inlineRadio1">默认</label>
          </div>
          <div class="form-check form-check-inline" style="height:38px">
            <input class="form-check-input" id="inlineRadio2" type="radio" name="status" value="2">
            <label class="form-check-label" for="inlineRadio2">推荐</label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          {{csrf_field()}}
          <button type="submit" class="btn btn-primary mr-2">提交表单</button>
          <a href="{{url('content')}}" class="btn btn-secondary">返回列表</a>
        </div>
      </div>
    </form>
  </div>
</div>
<link href="{{asset('admin')}}/common/uploader/uploadifive.css" rel="stylesheet" />
<script src="{{asset('admin')}}/common/uploader/jquery.uploadifive.js"></script>
<script src="{{asset('admin')}}/common/editor/ueditor1.4.3.3/ueditor.config.js"></script>
<script src="{{asset('admin')}}/common/editor/ueditor1.4.3.3/ueditor.all.min.js"></script>
<script src="{{asset('admin')}}/common/editor/main.editor.js"></script>
<script>
    main.menuActive('addcontent');
    $(function() {
      $('#file1').uploadifive({
        'auto'            : true,
        'fileObjName'     : 'image',
        'fileType'        : 'image',
        'buttonText'      : '上传图片',
        'formData'        : { '_token' : "{{ csrf_token() }}" },
        'method'          : 'post',
        'queueID'         : 'uploadImg',
        'removeCompleted' : true,
        'uploadScript'    : '{{ url('content/upload')}}',
        'onUploadComplete': uploadPicture_icon
      });
    });
    function uploadPicture_icon(file, data) {
      var obj = $.parseJSON(data);
      var src = '';
      if (obj.code) {
        filename = obj.data.filename;
        path = obj.data.path;
        $('.upload-img-box').empty();
        $('.upload-img-box').html(
          '<div class="upload-pre-item" style="max-height:100%;"><img src="' + path + '" style="width:100px;height:100px"/> <input type="hidden" name="image" value="'+filename+'" class="icon_banner"/></div>'
        );
      } else {
        alert(data.info);
      }
    }
    main.editor($('.j-goods-content'), 'goods_edit', function(opt) {
      opt.UEDITOR_HOME_URL = '{{asset('admin')}}/common/editor/ueditor1.4.3.3/';
    }, function(editor) {
      $('.j-form').submit(function() {
        editor.sync();
      });
    });
</script>
@endsection

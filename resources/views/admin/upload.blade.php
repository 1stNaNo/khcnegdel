@extends('layouts.adminNoMenu')

@section('content')
<div id="window_uploadIndex" class="page-window active-window">
  <div class="page-title">
    <i class="icon-custom-left"></i>
    @if($upload_type == 1)
      <h3>{{trans('resource.upload.title')}} - <span class="semi-bold">{{trans('resource.upload.imageUpload')}}</span></h3>
    @elseif($upload_type == 2)
      <h3>{{trans('resource.upload.title')}} - <span class="semi-bold">{{trans('resource.upload.thumbUpload')}}</span></h3>
    @elseif($upload_type == 3)
      <h3>{{trans('resource.upload.title')}} - <span class="semi-bold">{{trans('resource.upload.bannerUpload')}}</span></h3>
    @endif
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="row-fluid">
        <div class="grid simple">
          <div class="grid-title no-border">
            <h4>Drag n Drop <span class="semi-bold">Uploader</span></h4>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="grid-body no-border">
            <div class="row-fluid">
              @if($upload_type == 1)
                <form id="basic-image" action="/admin/upload/do" class="dropzone no-margin" />
              @elseif($upload_type == 2)
                <form id="basic-image" action="/admin/upload/thumbnail" class="dropzone no-margin" />
              @elseif($upload_type == 3)
                <form id="basic-image" action="/admin/upload/banner" class="dropzone no-margin" />
              @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="fallback">
                  <input name="file" type="file" multiple="" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <script type="text/javascript">
    $(document).ready(function() {
      Dropzone.options.basicImage = {
        acceptedFiles: "image/*"
      }
    });
  </script>
@endsection

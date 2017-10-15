@extends('layouts.admin')

@section('content')
<div id="window_galleryIndex" class="page-window active-window">
  <div class="page-title">
    <i class="icon-custom-left"></i>
      <h3>{{trans('resource.upload.title')}} - <span class="semi-bold">{{trans('resource.upload.gallery')}}</span></h3>
  </div>
  <div class="page-title">
    <a href="/admin/gallery/basic">{{trans('resource.upload.image')}}</a> /
    <a href="/admin/gallery/thumbnail">{{trans('resource.upload.thumbnail')}}</a>
    <div class="control-group">
      <label class="control-label">{{trans('resource.upload.name')}}</label>
      <div class="controls">
        <input class="span12 " type="text" name="superboxname">
      </div>
    </div>
  </div>
  <div class="superbox" style="background: #fff;">
				@foreach($model as $item)
          <div class="superbox-list"><!--
          --><img img-name="{{$item->name}}" src="{{$item->path}}" data-img="{{$item->path}}" alt="" class="superbox-img"/>
          </div>
        @endforeach
				<div class="superbox-float"></div>
	</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.superbox').SuperBox();
    $('.superbox-img').click(function(){
        $('input[name="superboxname"]').val($(this).attr("src"));
    });
  });
</script>
@endsection

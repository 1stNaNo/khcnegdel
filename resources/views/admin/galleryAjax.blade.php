<div id="window_galleryIndex" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <div class="page-title">
    <i class="icon-custom-left"></i>
      <h3>{{trans('resource.upload.title')}} - <span class="semi-bold">{{trans('resource.upload.gallery')}}</span></h3>
  </div>
  <div class="page-title">
    <div class="control-group">
      <label class="control-label">{{trans('resource.upload.name')}}</label>
      <div class="controls">
        <input class="span12 " type="text" name="superboxname">
        <input class="span12 " type="hidden" name="superboxnamehidden">
      </div>
    </div>
  </div>
  <div class="superbox" style="background: #fff;">
				@foreach($model as $item)
          <div class="superbox-list"><!--
          --><img img-name="{{$item->name}}" src="{{$item->path}}" data-img="{{$item->path}}" alt="" class="superbox-img" style="width: 160px; height:160px;"/>
          </div>
        @endforeach
				<div class="superbox-float"></div>
	</div>
  <div class="modal-footer">
    <button class="btn" onclick="uPage.close('window_galleryIndex', function(){})">{{trans('resource.buttons.close')}}</button>
    @if($backType == "summernote")
        <button class="btn btn-primary" onclick="uPage.close('window_galleryIndex', function(){ ugallery.setToSummerNote(); })">{{trans('resource.buttons.choose')}}</button>
      @else
        <button class="btn btn-primary" onclick="uPage.close('window_galleryIndex', function(){ ugallery.setToInput('{{$input}}'); })">{{trans('resource.buttons.choose')}}</button>
    @endif
  </div>



  <script type="text/javascript">
    $(document).ready(function(){
      $('.superbox').SuperBox();
      $('.superbox-img').click(function(){
          $('input[name="superboxname"]').val($(this).attr("img-name"));
          $('input[name="superboxnamehidden"]').val($(this).attr("data-img"));
      });
    });

    var ugallery = {
        setToInput: function(input){
            $("#" + input).val($('input[name="superboxnamehidden"]').val());
        },

        setToSummerNote: function(){
            selectedContext.invoke('insertImage', $('input[name="superboxnamehidden"]').val(), $('input[name="superboxname"]').val());
        }
    }
  </script>
</div>

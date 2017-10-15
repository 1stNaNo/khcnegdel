<div id="window_newsIndex" class="page-window">
    <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.news.title')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="news_action_form" class="form-horizontal form-bordered">
                <input type="hidden" name="id" value="{{ (count($vw_news) > 0) ? $vw_news->id : '' }}"/>
                  @foreach($langs as $item)
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('resource.news.ntitle')}} {{$item->lang_name}}</label>
                      <div class="col-md-6">
                        <input class="form-control" type="text" value="{{ (count($source->get($item->lang_key)) > 0) ? $source->get($item->lang_key)->title : '' }}" name="title[{{$item->lang_key}}]">
                      </div>
                    </div>
                  @endforeach
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.upload.thumbnail')}}</label>
                    <div class="col-md-6">
                      <div class="input-group">
												<input class="form-control" id="thumbnail" name="thumbnail" value="{{ (count($vw_news) > 0) ? $vw_news->thumbnail : '' }}" type="text">
												<div class="spinner-buttons input-group-btn">
  													<span class="btn btn-default" id="lfm" data-input="thumbnail" data-preview="holder">
  														   <i class="fa fa-file-picture-o"></i>
  													</span>
												</div>
											</div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Category</label>
                    <div class="col-md-6">
                      <select id="category" name="category" style="width:100%">
                        @foreach($category as $item)
                          @if(count($newscat) > 0)
                                @if($newscat->cat_id == $item->ca_id)
                                    <option selected="selected" value="{{$item->ca_id}}">{{$item->source}}</option>
                                @else
                                    <option value="{{$item->ca_id}}">{{$item->source}}</option>
                                @endif
                          @else
                              <option value="{{$item->ca_id}}">{{$item->source}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.news.publish')}}</label>
                    <div class="col-md-6">
                      <div class="checkbox check-default checkbox-circle">
                          @if(count($vw_news) > 0)
                            @if($vw_news->slide == 1)
                                <input id="checkbox7" style="margin-left: 0;" name="slide" value="1" checked="checked" type="checkbox">
                            @else
                              <input id="checkbox7" style="margin-left: 0;" name="slide" value="1" type="checkbox">
                            @endif
                          @else
                              <input id="checkbox7" style="margin-left: 0;" name="slide" value="1" type="checkbox">
                          @endif
                      </div>
                    </div>
                  </div>
                @foreach($langs as $item)
                  <div class="form-group">
                    <div class="col-md-12">
                        {{-- <div id="content_{{$item->lang_key}}" name="content[{{$item->lang_key}}]" class="summernote"></div> --}}
                        {{-- <div id="content_{{$item->lang_key}}" name="content[{{$item->lang_key}}]" stye="height: 300px;" class="summernote"></div> --}}
                        {{trans('resource.news.content')}} <span class="semi-bold">{{$item->lang_name}}
                        <textarea id="content_{{$item->lang_key}}" name="content[{{$item->lang_key}}]" class="form-control summernote"></textarea>
                    </div>
                  </div>
                @endforeach
                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="unews.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_newsIndex')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
              <usource style="display: none;">
                @foreach ($langs as $item)
                    <item name='{!! $item->lang_key !!}'>{!! (count($source->get($item->lang_key)) > 0) ? $source->get($item->lang_key)->source : '' !!}</item>
                @endforeach
              </usource>
            </div>
          </section>
      </div>
  </div>

<script type="text/javascript">
    $(document).ready(function(){

      $("#category").select2();


    $('.summernote').ckeditor({
      height: 400,
      filebrowserImageBrowseUrl: route_prefix + '?type=Images',
      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: route_prefix + '?type=Files',
      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
      language: 'mn'
    });

    $("usource").find("item").each(function(){
      CKEDITOR.instances["content_"+ $(this).attr('name')].setData($(this).html());
      // $("#content_"+ $(this).attr('name')).summernote("code", $(this).html());
    });

    var selectedContext = "";

    $('#lfm').filemanager('image', {prefix: route_prefix});
  });
</script>
</div>

@extends('layouts.admin')

@section('content')
<div id="window_newscat" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.contentcat.contentcat')}}</h2>
            </header>
            <div class="panel-body">
              <form action="savenewscat" id="newscat_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                @foreach($contentcats as $contentcat)
                  <input type="hidden" name="contentid[{{$contentcat->id}}]" value="{{$contentcat->id}}"/>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('resource.name')}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="title" class="" disabled="true" value="{{$contentcat->content_name}}"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('resource.category.title')}}</label>
                    <div class="col-sm-6">
                      <select id="category" name="categoryid[{{$contentcat->id}}]" style="width:100%" value="{{$contentcat->cat_id}}">
                      @foreach($categories as $category)

                        @if($category->ca_id == $contentcat->id)
                          <option selected="selected" value="{{$category->ca_id}}">{{$category->source}}</option>
                        @else
                          <option value="{{$category->ca_id}}">{{$category->source}}</option>
                        @endif

                      @endforeach
                      </select>

                    </div>
                  </div>

                @endforeach

                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="saveContentCat();">{{trans('resource.buttons.save')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
    </div>

  <script type="text/javascript">
  function saveContentCat(){
    $.ajax({
        url: '/admin/savenewscat',
        type: "POST",
        dataType: "json",
        data : new FormData($("#newscat_form")[0]),
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success: function(data){
            if(data.type == 'success'){
              umsg.success(messages.saved);
            }else{
              uvalidate.setErrors(data);
            }
        }
    });
  }

  $(function(){
    $("#window_newscat").find('select').each(function(){
      $(this).select2();
      $(this).val($(this).attr('value')).trigger('change');
    });
  });
</script>
@endsection

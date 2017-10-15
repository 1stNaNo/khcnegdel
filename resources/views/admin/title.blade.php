@extends('layouts.admin')

@section('content')
<div id="window_title" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.webtitle')}}</h2>
            </header>
            <div class="panel-body">
              <form action="titlesave" id="title_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="id" value="1"/>
                @foreach($langs as $lang)
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('resource.webtitle')}} {{$lang->lang_key}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="span12" name="title[{{$lang->lang_key}}]" value="{{!empty($title) ? $title->whereIn('lang', $lang->lang_key)->first()->title : ''}}" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('resource.shorter')}} {{$lang->lang_key}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="span12" name="body[{{$lang->lang_key}}]" value="{{!empty($title) ? $title->whereIn('lang', $lang->lang_key)->first()->body : ''}}" />
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
  </div>
  <script type="text/javascript">
  function saveContentCat(){
    $.ajax({
        url: '/admin/titlesave',
        type: "POST",
        dataType: "json",
        data : new FormData($("#title_form")[0]),
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

</script>
@endsection

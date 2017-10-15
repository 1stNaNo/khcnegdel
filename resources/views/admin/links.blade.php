@extends('layouts.admin')

@section('content')
<div id="window_links" class="page-window active-window">
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.weblinks.link')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="links_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                @foreach($links as $link)
                  <input type="hidden" name="id[{{$link->id}}]" value="{{$link->id}}"/>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.name')}}</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="title" class="" disabled="true" value="{{$link->type}}"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.link')}}</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="link[{{$link->id}}]" class="" value="{{$link->link}}"/>
                    </div>
                  </div>
                @endforeach


                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="ulinks.save();">{{trans('resource.buttons.save')}}</button>
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
  var ulinks = {
    save : function(){
      $.ajax({
          url: '/admin/linkssave',
          type: "POST",
          dataType: "json",
          data : new FormData($("#links_form")[0]),
          processData: false,  // tell jQuery not to process the data
          contentType: false,  // tell jQuery not to set contentType
          success: function(data){
              if(data.type == 'success'){
                umsg.success(messages.saved);
                uPage.close('window_bannerRegister');
                baseGridFunc.reload("banner_grid");
              }else{
                  uvalidate.setErrors(data);
              }
          }
      });
    }
  }

</script>
@endsection

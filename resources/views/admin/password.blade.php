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

              <h2 class="panel-title">{{trans('resource.password')}}</h2>
            </header>
            <div class="panel-body">
              <form action="password/save" id="title_form" class="form-horizontal form-bordered">
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.password')}}</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="password" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.passwordconf')}}</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="password_confirmation"/>
                  </div>
                </div>
                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="saveContentCat(); return false;">{{trans('resource.buttons.save')}}</button>
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
          url: '/admin/password/save',
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
</div>
@endsection

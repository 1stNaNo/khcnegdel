@extends('layouts.admin')

@section('content')
<div id="window_intervalRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.sys.interval')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="intervalRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Эхлэх өдөр')}}</label>
                  <div class="col-md-3">
                    <div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 7 }'>
                      <div class="input-group">
                        <input value="{{(!empty($sysInterval)) ? $sysInterval->start_day : ''}}" type="text" class="spinner-input form-control" maxlength="3" name="start_day" readonly>
                        <div class="spinner-buttons input-group-btn">
                          <button type="button" class="btn btn-default spinner-up">
                            <i class="fa fa-angle-up"></i>
                          </button>
                          <button type="button" class="btn btn-default spinner-down">
                            <i class="fa fa-angle-down"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    {{-- <p>
                      with <code>max</code> value set to 10
                    </p> --}}
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Эхлэх цаг')}}</label>
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </span>
                      <input name="start_time" value="{{(!empty($sysInterval)) ? $sysInterval->start_time : ''}}" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Дуусах өдөр')}}</label>
                  <div class="col-md-3">
                    <div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 7 }'>
                      <div class="input-group">
                        <input value="{{(!empty($sysInterval)) ? $sysInterval->end_day : ''}}" type="text" class="spinner-input form-control" maxlength="3" name="end_day" readonly>
                        <div class="spinner-buttons input-group-btn">
                          <button type="button" class="btn btn-default spinner-up">
                            <i class="fa fa-angle-up"></i>
                          </button>
                          <button type="button" class="btn btn-default spinner-down">
                            <i class="fa fa-angle-down"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    {{-- <p>
                      with <code>max</code> value set to 10
                    </p> --}}
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Дуусах цаг')}}</label>
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </span>
                      <input name="end_time" value="{{(!empty($sysInterval)) ? $sysInterval->end_time : ''}}" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'>
                    </div>
                  </div>
                </div>


                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="sysinterval.save();">{{trans('resource.buttons.save')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
  <script type="text/javascript">
      $(document).ready(function(){

        $(".uselect2").select2();

      });

      var sysinterval = {

          save: function(){

              $.ajax({
                  url: '/sys/interval/save',
                  type: "POST",
                  dataType: "json",
                  data : $("#intervalRegister_form").serializeObject(),
                  success: function(data){
                      if(data.type == 'success'){
                        umsg.success(messages.saved);
                      }else{
                        uvalidate.setErrors(data);
                      }
                  }
              });
          }
      }
  </script>
</div>
@endsection

<div id="window_externalIndex" class="page-window">
    <input type="hidden" class="prev_window"/>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">{{trans('resource.main.external')}}</h2>
              </header>
              <div class="panel-body">
                <form action="" id="external_action_form" class="form-horizontal form-bordered">
                  <input type="hidden" name="id" value="{{ (count($external) > 0) ? $external->id : '' }}"/>
                  <div class="form-group" id="linkCont">
                    <label class="col-md-3 control-label">{{trans('resource.category.link')}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (count($external) > 0) ? $external->link: ''}}" name="link">
                    </div>
                  </div>
                  <div class="form-group" id="linkCont">
                    <label class="col-md-3 control-label">{{trans('resource.main.count')}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (count($external) > 0) ? $external->count: ''}}" name="count">
                    </div>
                  </div>
                  <div class="form-group usticky" style="background: #fff;">
                    <div class="col-md-12">
                      <div style="float: right;">
                        <button type="button" class="btn btn-primary" onclick="uexternal.save();">{{trans('resource.buttons.save')}}</button>
                        <button type="button" class="btn" onclick="uPage.close('window_externalIndex')">{{trans('resource.buttons.close')}}</button>
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
      </script>
    </div>
</div>

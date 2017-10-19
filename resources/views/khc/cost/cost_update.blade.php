
<div id="window_costRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">Худалдан авагч</h2>
            </header>
            <div class="panel-body">
              <form action="" id="costRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="cost_id" value="{{ $cost->cost_id }}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.name')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="name" class="" value="{{ $cost->name }}"/>
                  </div>
                </div>

                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="cost.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_costRegister')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
  <script type="text/javascript">
  </script>
</div>

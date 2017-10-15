
<div id="window_decisionRegister" class="page-window">
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
              <form action="{{ url('/admin/decisionsave') }}" id="decisionRegister_form" class="form-horizontal form-bordered">
                <input type="hidden" name="id" value="{{$id}}"/>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.decision.solution')}}</label>
                  <div class="col-md-6">
                    <textarea class="form-control" cols="30" name="decision" class="" style="resize: none;"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.category.target')}}</label>
                  <div class="col-md-6">
                    <select id="kind" name="kind">
                      <option value="1">Эерэг</option>
                      <option value="2">Сөрөг</option>
                    </select>
                  </div>
                </div>
                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="udecision.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_decisionRegister')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
</div>

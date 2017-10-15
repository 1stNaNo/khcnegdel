
<div id="window_pollRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.poll.register')}}</h2>
            </header>
            <div class="panel-body">
              <form action="{{ url('/admin/pollsave') }}" id="pollRegister_form" class="form-horizontal form-bordered">

                @foreach($langs as $lang)
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.poll.question')}} /{{$lang->lang_key}}/</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="question[{{$lang->lang_key}}]" class="{{$lang->lang_key}}"/>
                    </div>
                  </div>
                @endforeach

                <div class="answer-container">
                    <div class="sub-container">
                      @foreach($langs as $lang)
                        <div class="answer-item">
                          <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('resource.poll.answer')}} /{{$lang->lang_key}}/</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" name="answer[0][{{$lang->lang_key}}]" lang="{{$lang->lang_key}}"/>
                            </div>
                          </div>
                        </div>
                      @endforeach
                      <div class="form-group">
                        <div class="col-md-12">
                          <button type="button" class="btn btn-primary btn-cons pull-right remove-btn" style="display: none;" onclick="upoll.removeAnswer(this); return false;">-</button>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <button style="margin-top: 5px;" type="button" class="btn btn-primary btn-cons pull-right" onclick="upoll.addAnswer(); return false;">+</button>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label" for="checkbox_ismakeactive">{{trans('resource.poll.makeactive')}}</label>
                  <div class="col-md-6">
                    <div class="checkbox check-default checkbox-circle">
                      <input id="checkbox_ismakeactive" style="margin-left: 0" name="active_flag" value="1" type="checkbox" />
                    </div>
                  </div>
                </div>

                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="uForm.register('pollRegister_form', function(data){ console.log(data); uPage.close('window_pollRegister'); baseGridFunc.reload('poll_grid') });return false;">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_pollRegister')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
</div>

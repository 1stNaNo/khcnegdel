<div id="window_shorterIndex" class="page-window">
    <input type="hidden" class="prev_window"/>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">{{ trans('resource.main.shorter') }}</h2>
              </header>
              <div class="panel-body">
                <form action="" id="shorter_action_form" class="form-horizontal form-bordered">
                  <input type="hidden" name="id" value="{{ (!empty($vw_shorter)) ? $vw_shorter->id : ''}}"/>
                  @foreach($langs as $item)
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('resource.news.ntitle')}} {{$item->lang_key}}</label>
                      <div class="col-md-6">
                        <input class="form-control " type="text" value="{{ (!empty($source)) ? ((!empty($source->get($item->lang_key))) ? $source->get($item->lang_key)->source : '') : ''}}" name="title[{{$item->lang_key}}]">
                      </div>
                    </div>
                  @endforeach
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.link')}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (!empty($vw_shorter)) ? $vw_shorter->url : ''}}" name="link">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.target')}}</label>
                    <div class="col-md-6">
                      <select id="target" name="target" class="uselect2" style="width:100%">
                        @if(!empty($vw_shorter))
                          @if($vw_shorter->target == 'self')
                            <option selected="selected" value="self">{{trans('resource.category.self')}}</option>
                            <option value="blank">{{trans('resource.category.blank')}}</option>
                          @else
                            <option value="self">{{trans('resource.category.self')}}</option>
                            <option selected="selected" value="blank">{{trans('resource.category.blank')}}</option>
                          @endif
                        @else
                          <option value="self">{{trans('resource.category.self')}}</option>
                          <option value="blank">{{trans('resource.category.blank')}}</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.poll.status')}}</label>
                    <div class="col-md-6">
                      <select id="show" name="show" class="uselect2" style="width:100%">
                        @if(!empty($vw_shorter))
                          @if($vw_shorter->show == 1)
                            <option value="1" selected="selected">{{trans('resource.poll.active')}}</option>
                            <option value="0">{{trans('resource.poll.inactive')}}</option>
                          @else
                            <option value="1">{{trans('resource.poll.active')}}</option>
                            <option value="0" selected="selected">{{trans('resource.poll.inactive')}}</option>
                          @endif
                        @else
                          <option value="1">{{trans('resource.poll.active')}}</option>
                          <option value="0">{{trans('resource.poll.inactive')}}</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group usticky" style="background: #fff;">
                    <div class="col-md-12">
                      <div style="float: right;">
                        <button type="button" class="btn btn-primary" onclick="ushorter.save();">{{trans('resource.buttons.save')}}</button>
                        <button type="button" class="btn" onclick="uPage.close('window_shorterIndex')">{{trans('resource.buttons.close')}}</button>
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

            $(".uselect2").select2();

          });
      </script>
    </div>
</div>


<div id="window_costtemplateRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">Зардалын загвар</h2>
            </header>
            <div class="panel-body">
              <form action="" id="costtemplateRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="cost_template_id" value="{{ $costtemplate->cost_template_id }}"/>


                <div class="form-group" id="linkCont">
                  <label class="col-md-3 control-label">{{trans('Агуулах')}}</label>
                  <div class="col-md-6">
                    <select name="wh_id" class="" style="width : 100%">
                      <option value="">Сонго</option>
                      @foreach($warehouses as $c)
                        @if($costtemplate->wh_id == $c->wh_id)
                        <option value="{{$c->wh_id}}" selected="selected">{{$c->name}}</option>
                        @else
                        <option value="{{$c->wh_id}}">{{$c->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>

                @foreach($costs as $c)
                <div class="form-group">
                  <label class="col-md-3 control-label">{{$c->name}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="amount[{{$c->cost_id}}]" class="" value="{{$c->amount}}"/>
                  </div>
                </div>
                @endforeach

                

                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="costtemplate.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_costtemplateRegister')">{{trans('resource.buttons.close')}}</button>
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

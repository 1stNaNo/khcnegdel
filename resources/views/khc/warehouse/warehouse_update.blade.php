
<div id="window_warehouseRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">Агуулах</h2>
            </header>
            <div class="panel-body">
              <form action="" id="warehouseRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="wh_id" value="{{ $warehouse->wh_id }}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.name')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="name" class="" value="{{$warehouse->name}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Утас</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="phone" class="" value="{{$warehouse->phone}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Улс')}}</label>
                  <div class="col-md-6">
                    <select name="country_id" onchange="changeSelectValue('window_warehouseRegister',$('[name=city_id]'), $(this).val());">
                      <option selected="selected" value="">Сонго</option>
                      @foreach($countries as $c)
                        @if($warehouse->country_id == $c->id)
                          <option selected="selected" value="{{$c->id}}">{{$c->name}}</option>
                        @else
                          <option value="{{$c->id}}">{{$c->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Хот')}}</label>
                  <div class="col-md-6">
                    <select name="city_id" onchange="changeSelectValue('window_warehouseRegister',$('[name=district_id]'), $(this).val())">
                      @if(empty($cities))
                        <option selected="selected" value="">Сонго</option>
                      @else
                        <option selected="selected" value="{{$cities->id}}">{{$cities->name}}</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Дүүрэг')}}</label>
                  <div class="col-md-6">
                    <select name="district_id">
                      @if(empty($districts))
                        <option selected="selected" value="">Сонго</option>
                      @else
                        <option selected="selected" value="{{$districts->id}}">{{$districts->name}}</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    @if($warehouse->is_centre)
                      <input id="checkbox7" style="margin-left: 0;" name="is_centre" value="1" checked="checked" type="checkbox"> Төв салбар эсэх
                    @else
                      <input id="checkbox7" style="margin-left: 0;" name="is_centre" value="1" type="checkbox"> Төв салбар эсэх
                    @endif
                  </div>
                </div>


                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="warehouse.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_warehouseRegister')">{{trans('resource.buttons.close')}}</button>
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

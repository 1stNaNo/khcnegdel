<div id="window_productRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('Бараа / Төрөл бүртгэл')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="productRegister_Form" class="form-horizontal form-bordered">
                <input type="hidden" name="id" value="{{$model->id}}"/>
                <input type="hidden" name="parent_id" value="{{$model->parent_id}}"/>
                <div class="form-group" id="linkCont">
                  <label class="col-md-3 control-label">{{trans('Нэр')}}</label>
                  <div class="col-md-6">
                    <input class="form-control " type="text" value="{{$model->name}}" name="name">
                  </div>
                </div>
                <div class="form-group" id="linkCont">
                  <label class="col-md-3 control-label">{{trans('Код')}}</label>
                  <div class="col-md-6">
                    <input class="form-control " type="text" value="{{$model->code}}" name="code">
                  </div>
                </div>
                <div class="form-group" id="linkCont">
                  <label class="col-md-3 control-label">{{trans('Бар код')}}</label>
                  <div class="col-md-6">
                    <input class="form-control " type="text" value="{{$model->bar_code}}" name="bar_code">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Төрөл')}}</label>
                  <div class="col-md-6">
                    <select value="" name="type" class="uselect2" style="width:100%" onchange="sys.product.hsUnit();">
                      <option  value="">Сонго</option>
                      <option {{($model->type == "2") ? "selected": ""}}  value="2">Бараа</option>
                      <option {{($model->type == "1") ? "selected": ""}} value="1">Төрөл</option>
                    </select>
                  </div>
                </div>
                <div class="form-group" id="unitCont">
                  <label class="col-md-3 control-label">{{trans('Хэмжих нэгж')}}</label>
                  <div class="col-md-6">
                    <select name="unit" style="width:100%" multiple="">
                      @foreach($unit as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group" id="supCont">
                  <label class="col-md-3 control-label">{{trans('Нийлүүлэгч')}}</label>
                  <div class="col-md-6">
                    <select value="" name="suplier" class="uselect2" style="width:100%">
                      <option  value="">Сонго</option>
                      @foreach($purchaser as $item)
                        @if($item->purchaser_id == $model->suplier)
                          <option selected value="{{$item->purchaser_id}}">{{$item->name}}</option>
                        @else
                          <option value="{{$item->purchaser_id}}">{{$item->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="sys.product.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_productRegister')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
  <script type="text/javascript">

      var productUnit = {!! $unit_prod !!};

      $(document).ready(function(){
        sys.product.hsUnit();
        // $(".uselect2").select2();
        var unit = [];

        for(var key in productUnit){
          unit.push(productUnit[key].master_id);
        }

        $("#productRegister_Form select[name='unit']").val(unit).select2();
      });
  </script>
</div>

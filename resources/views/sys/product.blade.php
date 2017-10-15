
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

              <h2 class="panel-title">{{trans('resource.sys.product')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="productRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="id" value="{{ (!empty($vw_product)) ? $vw_product->id : '' }}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.name')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="name" class="" value="{{(!empty($vw_product)) ? $vw_product->name : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Төрөл')}}</label>
                  <div class="col-md-6">
                    <select name="type">
                      @foreach($product_type as $item)
                          @if(!empty($vw_product))
                            @if($vw_product->cat == $item->id)
                              <option selected="selected" value="{{$item->id}}">{{$item->name}}</option>
                            @else
                              <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                          @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Хуваах эсэх')}}</label>
                  <div class="col-md-6">
                    <select name="split">
                      @if(!empty($vw_product))
                        @if($vw_product->split == 0)
                          <option selected="selected" value="0">Хуваахгүй</option>
                          <option value="1">Хуваана</option>
                        @else
                          <option value="0">Хуваахгүй</option>
                          <option selected="selected" value="1">Хуваана</option>
                        @endif
                      @else
                        <option value="0">Хуваахгүй</option>
                        <option value="1">Хуваана</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Хэмжих нэгж')}}</label>
                  <div class="col-md-6">
                    <select name="unit" style="width:100%" multiple="">
                      @foreach($sysMaster as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>


                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="sysproduct.save();">{{trans('resource.buttons.save')}}</button>
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
      var productUnit = {!! $unit !!};
      $(document).ready(function(){

        $(".uselect2").select2();

        var unit = [];

        for(var key in productUnit){
          unit.push(productUnit[key].master_id);
        }

        $("select[name='unit']").val(unit).select2();

      });
  </script>
</div>

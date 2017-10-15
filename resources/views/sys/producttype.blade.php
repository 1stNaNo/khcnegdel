
<div id="window_productTypeRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.sys.producttype')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="productTypeRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="id" value="{{ (!empty($vw_product_type)) ? $vw_product_type->id : '' }}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.name')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="span12" name="name" class="" value="{{(!empty($vw_product_type)) ? $vw_product_type->name : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Хамаарал')}}</label>
                  <div class="col-md-6">
                    <select name="parent">
                      <option value="0"></option>
                        @foreach($product_type as $item)
                          @if(!empty($vw_product_type))
                            @if($vw_product_type->parent_id == $item->id)
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
                  <label class="col-md-3 control-label">{{trans('Эрэмбэ')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="span12" name="numb" class="" value="{{(!empty($vw_product_type)) ? $vw_product_type->numb : ''}}"/>
                  </div>
                </div>


                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="sysproductType.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_productTypeRegister')">{{trans('resource.buttons.close')}}</button>
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


<div id="window_employerRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">Ажилтан</h2>
            </header>
            <div class="panel-body">
              <form action="" id="employerRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="emp_id" value="{{ $employer->emp_id }}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.name')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="firstname" class="" value="{{$employer->firstname}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Овог</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="lastname" class="" value="{{$employer->lastname}}"/>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Агуулах')}}</label>
                  <div class="col-md-6">
                    <select name="country_id">
                      @foreach($warehouses as $c)
                        @if($employer->wh_id == $c->wh_id)
                          <option selected="selected" value="{{$c->wh_id}}">{{$c->name}}</option>
                        @else
                          <option value="{{$c->wh_id}}">{{$c->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Улс')}}</label>
                  <div class="col-md-6">
                    <select name="country_id" class="uselect2">
                      @foreach($countries as $c)
                        @if($employer->country_id == $c->id)
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
                    <select name="city_id" class="uselect2">
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
                    <select name="district_id" class="uselect2">
                      @if(empty($districts))
                        <option selected="selected" value="">Сонго</option>
                      @else
                        <option selected="selected" value="{{$districts->id}}">{{$districts->name}}</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Утас</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="phone" class="" value="{{$employer->phone}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Хаяг</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="address" class="" value="{{$employer->address}}"/>
                  </div>
                </div>

                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="employer.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_employerRegister')">{{trans('resource.buttons.close')}}</button>
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

      $('[name="country_id"]').on('change', function(){
        $.get('/address/get/child', {'id': $(this).val()}, function(data){
          console.log(data);
        });
      });
  </script>
</div>

<div id="window_addressRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('Хаяг бүртгэл')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="addressRegister_Form" class="form-horizontal form-bordered">
                <input type="hidden" name="id" value="{{$sysAddress->id}}"/>
                <input type="hidden" name="parent_id" value="{{$sysAddress->parent_id}}"/>
                <div class="form-group" id="linkCont">
                  <label class="col-md-3 control-label">{{trans('Нэр')}}</label>
                  <div class="col-md-6">
                    <input class="form-control " type="text" value="{{$sysAddress->name}}" name="name">
                  </div>
                </div>
                <div class="form-group" id="linkCont">
                  <label class="col-md-3 control-label">{{trans('Код')}}</label>
                  <div class="col-md-6">
                    <input class="form-control " type="text" value="{{$sysAddress->code}}" name="code">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Төрөл')}}</label>
                  <div class="col-md-6">
                    <select value="" name="type" class="uselect2" style="width:100%">
                      <option  value=""></option>
                      <option {{($sysAddress->type == "country") ? "selected": ""}}  value="country">Улс</option>
                      <option {{($sysAddress->type == "city") ? "selected": ""}} value="city">Хот/аймаг</option>
                      <option {{($sysAddress->type == "district") ? "selected": ""}} value="district">Дүүрэг/Сум</option>
                      <option {{($sysAddress->type == "other") ? "selected": ""}} value="other">Бусад</option>
                    </select>
                  </div>
                </div>
                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="sys.address.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_addressRegister')">{{trans('resource.buttons.close')}}</button>
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

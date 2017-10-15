<div id="window_orderedit" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <form action="/sys/order/save" id="orderedit_form" class="form-horizontal form-bordered">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <div class="panel-actions">
              <a class="panel-action panel-action-toggle" href="#" data-panel-toggle=""></a>
              <a class="panel-action panel-action-dismiss" href="#" data-panel-dismiss=""></a>
            </div>
            <h2 class="panel-title">Захиалга бүртгэл</h2>
          </header>

          <div class="panel-body">
            <input type="hidden" value="{{$order_id}}" name="order_id"/>
            @foreach($orders as $o)

              <div class="form-group">
                <div class="col-md-4">
                  <input type="text" class="form-control" disabled="disabled" value="{{$o->product_name}}"/>
                </div>
                <div class="col-md-1">
                  <select id="unit_id" name="unit_id" class="uselect2 unit_id" style="width:100%">';
                    @foreach($units->where('product_id', $o->id)->get() as $u)
                      <option value="{{$u->master_id}}">{{$u->unit_name}}</option>;
                    @endforeach
                  </select>
                </div>
              </div>

            @endforeach

            <div class="form-group">
              <div class="col-md-12 form-group">
                <button class="btn pull-right" type="button" onclick="uPage.close('window_orderedit')">Хаах</button>
                <button class="btn btn-primary pull-right" type="button" onclick="continueOrder()">Хадгалах</button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

  </form>
  <script>

  </script>
</div>

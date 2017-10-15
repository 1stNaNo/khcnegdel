@extends('layouts.admin')

@section('content')
<div id="window_orderList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('Захиалга')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
            @if($isActive)
  					   <button id="orderAddBtn" onclick="uPage.call('/sys/orderregister', null); return false;" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
            {{-- @else
              <p style="color:red; font-weight: bold;text-decoration: underline;">Захиалгын хугацаа дууссан байна!</p> --}}
            @endif
  				</div>
  			</div>
      </div>
      <div class="grid-body">
        <div style="display: none;" class="ucolumn-cont" data-table="order_grid" rowclick="">
          <ucolumn name="id" source="id" visible="false"></ucolumn>
          <ucolumn name="client_id" source="client_id" visible="false"></ucolumn>
          <ucolumn name="confirm" source="confirm" visible="false"></ucolumn>
          <ucolumn name="name" source="name"></ucolumn>
          <ucolumn name="username" source="username"></ucolumn>
          <ucolumn name="confirm_name" source="confirm_name"></ucolumn>
          <ucolumn name="insert_date" source="insert_date"></ucolumn>
          <ucolumn name="comment" source="comment"></ucolumn>
          <ucolumn searchable="false" width="50px" name="edit_btn" source="edit_btn" utype="formatter" func="uorder.buttonFormatter"></ucolumn>
          {{-- <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="editorderproduct" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn> --}}
        </div>
        <table action="/sys/order/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="order_grid" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>Байгууллага</th>
              <th>Хэрэглэгч</th>
              <th>Төлөв</th>
              <th>Огноо</th>
              <th>Тайлбар</th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
      <input type="hidden" name="confStart_date" value="{{$start_date}}"/>
      <input type="hidden" name="confEnd_date" value="{{$end_date}}"/>
      <form action="/sys/order/report" method="get">
        <br>
        <div class="row">
          <div class="col-md-12">
            @if(Auth::user()->can('orderReport'))
              <button type="button" class="btn btn-success" onclick="$('#dateRange').modal('show')">Excel</button>
            @endif
              <div class="modal fade" id="dateRange" role="dialog" style="">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Тайлан</h4>
                    </div>
                    <div class="modal-body" id="modal-body">
                      <div class="form-group">
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                          <div class="input-daterange input-group" data-plugin-datepicker="" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input class="form-control" name="start" type="text" >
                            <span class="input-group-addon"> - </span>
                            <input class="form-control" name="end" type="text">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12" style="text-align: center;">
                          <button type="submit" class="btn btn-success">Татах</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
          </div>
        </div>
      </form>
  	</div>
  </section>
</div>
<script type="text/javascript">
  function orderreport(){

  }

  $(document).ready(function() {

      var buttons = [];
      // buttons.push('<button onclick="ucategory.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("order_grid", buttons);
  });

  var uorder = {

    edit: function(id){
        rowData = {};
        rowData["id"] = id;
        uPage.call('/sys/orderregister', rowData);
    },

    buttonFormatter: function(data, type, row){

      var tmpBtn = '';

        if($("input[name='confStart_date']").val() <= row.insert_date && $("input[name='confEnd_date']").val() >= row.insert_date){
          tmpBtn = '<span onclick="uorder.edit('+ row.id +')" class="gridIcon fa fa-pencil ucGreen" title="Засах"></span>';
        }else{
          tmpBtn = '<span onclick="uorder.view('+ row.id +')" class="gridIcon fa fa-eye" title="Харах"></span>';
        }


      return tmpBtn;
    },

    view : function(id){
      uPage.call('/sys/order/confirmindex',{ 'id' : id, 'view' : true });
    }
  };

  uorderReg = {
      category: function(){
        uPage.call('/sys/order/category', {});
      }
  };

  function editorderproduct(gridId ,elmnt){
    var rowData = baseGridFunc.getRowData(gridId ,elmnt);
    $.post('/sys/order/checkInterval', rowData, function(data){
      if(data.isActive){
        uPage.call('/sys/orderregister', rowData);
      }else{
        umsg.error('Хугацаа дууссан тул засах боломжгүй');
      }
    });
  }

</script>
  @endsection

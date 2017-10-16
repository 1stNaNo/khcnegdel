@extends('layouts.admin')

@section('content')
  <div id="window_warehouseList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
      </div>

      <h2 class="panel-title">Агуулах бүртгэл</h2>
    </header>
    <div class="panel-body">
      <div class="row gridFilterWrapper">
        <form id="warehouseSearch_Form">
          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('resource.name')}} :</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="name"/>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Утас')}} :</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="phone"/>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Улс')}} :</label>
                <div class="col-md-12">
                  <select name="country_id" class="uselect2" style="width : 100%" onchange="changeSelectValue('window_warehouseList', $('[name=city_id]'), $(this).val());">
                    <option value="">Сонго</option>
                    @foreach($countries as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Хот')}} :</label>
                <div class="col-md-12">
                  <select name="city_id" class="uselect2" style="width : 100%" onchange="changeSelectValue('window_warehouseList', $('[name=district_id]'), $(this).val());">
                    <option value="">Сонго</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Сум/Дүүрэг')}} :</label>
                <div class="col-md-12">
                  <select name="district_id" class="uselect2" style="width : 100%">
                    <option value="">Сонго</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </form>   
        <div class="mb-md">
          <div class="form-group usticky" style="background: #fff;">
            <div class="col-md-12" style="text-align: center;">
              <div>
                <button type="button" class="btn btn-success" onclick="u$Grid.reload('warehouse_grid')">{{trans('Хайх')}}</button>
                <button type="button" class="btn btn-warning" onclick="$('#warehouseSearch_Form')[0].reset()">{{trans('Арилгах')}}</button>
                <button type="button" class="btn" onclick="u$Grid.toggleFilter(this)">{{trans('resource.buttons.close')}}</button>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-sm-6">
          <div class="mb-md">
            <button onclick="warehouse.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
          </div>
        </div> --}}
      </div>
      <div class="grid-body">
        <div style="display: none;" class="ucolumn-cont" data-table="warehouse_grid">
          <ucolumn name="index" source="index" utype="index" searchable="false" sortable="false"/>
          <ucolumn name="wh_id" source="wh_id" sort="true" visible="false"/>
          <ucolumn name="name" source="name" sort="true"/>
          <ucolumn name="country_name" source="country_name" sort="true"/>
          <ucolumn name="city_name" source="city_name" sort="true"/>
          <ucolumn name="district_name" source="district_name" sort="true"/>
          <ucolumn name="phone" source="phone" sort="true"/>
          <ucolumn name="is_centre" source="is_centre" sort="true" utype="formatter" func="warehouse.isCentre"/>
          <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="warehouse.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
          <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="warehouse.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
        </div>
        <table action="/khc/warehouse/data" id="warehouse_grid" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Нэр</th>
              <th>{{trans('Улс')}}</th>
              <th>{{trans('Аймаг/хот')}}</th>
              <th>{{trans('Сум/дүүрэг')}}</th>
              <th>{{trans('Утас')}}</th>
              <th>{{trans('Төв салбар эсэх')}}</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var buttons = [];
    buttons.push('<button onclick="warehouse.add()" class="btn btn-primary fRight">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>');
    buttons.push('<button onclick="u$Grid.toggleFilter(this)" class="btn btn-info fRight">{{trans('Хайлт')}} <i class="fa fa-search"></i></button>');
    baseGridFunc.init("warehouse_grid", buttons, "warehouseSearch_Form");

    $('.uselect2').select2();
  });

  var warehouse = {
      add: function(){
        var postData = {};
        uPage.call('/khc/warehouse/edit',postData);
      },

      edit: function(gridId ,elmnt){
          var rowData = baseGridFunc.getRowData(gridId ,elmnt);
          uPage.call('/khc/warehouse/edit',{'id' : rowData.wh_id});
      },

      save: function(){

          $.ajax({
              url: '/khc/warehouse/save',
              type: "POST",
              dataType: "json",
              data : $("#warehouseRegister_form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_warehouseRegister');
                    baseGridFunc.reload("warehouse_grid");
                  }else{
                    uvalidate.setErrors(data);
                  }
              }
          });
      },

      remove: function(gridId ,elmnt){
        uModal.remove(function(){
          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['wh_id'] = rowData.wh_id;
          $.ajax({
              url: '/khc/warehouse/delete',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("warehouse_grid");
                  }
              }
          });
        });
      },
      isCentre : function(data, type, row){
        if(row.is_centre == 1){
          return 'Тийм';
        }else{
          return 'Үгүй';
        }
      }
  }

</script>
@endsection

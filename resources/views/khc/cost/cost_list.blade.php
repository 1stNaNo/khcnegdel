@extends('layouts.admin')

@section('content')
  <div id="window_costList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
      </div>

      <h2 class="panel-title">Зардал</h2>
    </header>
    <div class="panel-body">
      <div class="row gridFilterWrapper">
        <form id="costSearch_Form">
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

        </form>
        <div class="mb-md">
          <div class="form-group usticky" style="background: #fff;">
            <div class="col-md-12" style="text-align: center;">
              <div>
                <button type="button" class="btn btn-success" onclick="u$Grid.reload('cost_grid')">{{trans('Хайх')}}</button>
                <button type="button" class="btn btn-warning" onclick="$('#costSearch_Form')[0].reset()">{{trans('Арилгах')}}</button>
                <button type="button" class="btn" onclick="u$Grid.toggleFilter(this)">{{trans('resource.buttons.close')}}</button>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-sm-6">
          <div class="mb-md">
            <button onclick="cost.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
          </div>
        </div> --}}
      </div>
      <div class="grid-body">
        <div style="display: none;" class="ucolumn-cont" data-table="cost_grid">
          <ucolumn width="10px" name="index" source="index" utype="index" searchable="false" sortable="false"/>
          <ucolumn name="cost_id" source="cost_id" sort="true" visible="false"/>
          <ucolumn width="100%" name="name" source="name" sort="true"/>
          <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="cost.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
          <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="cost.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
        </div>
        <table action="/khc/cost/data" id="cost_grid" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Нэр</th>
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
    buttons.push('<button onclick="cost.add()" class="btn btn-primary fRight">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>');
    buttons.push('<button onclick="u$Grid.toggleFilter(this)" class="btn btn-info fRight">{{trans('Хайлт')}} <i class="fa fa-search"></i></button>');
    baseGridFunc.init("cost_grid", buttons, "costSearch_Form");

    $('.uselect2').select2();
  });

  var cost = {
      add: function(){
        var postData = {};
        uPage.call('/khc/cost/edit',postData);
      },

      edit: function(gridId ,elmnt){
          var rowData = baseGridFunc.getRowData(gridId ,elmnt);
          uPage.call('/khc/cost/edit',{'cost_id' : rowData.cost_id});
      },

      save: function(){

          $.ajax({
              url: '/khc/cost/save',
              type: "POST",
              dataType: "json",
              data : $("#costRegister_form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_costRegister');
                    baseGridFunc.reload("cost_grid");
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
          postData['id'] = rowData.cost_id;
          $.ajax({
              url: '/khc/cost/delete',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("cost_grid");
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

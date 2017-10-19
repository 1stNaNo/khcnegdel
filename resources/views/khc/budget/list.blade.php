@extends('layouts.admin')

@section('content')
<div id="window_unitList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{ trans('Хэмжих нэгж') }}</h2>
  	</header>
  	<div class="panel-body">
          <div class="row gridFilterWrapper">
            <form id="unitSearch_Form">
            <div class="col-sm-4">
              <div class="mb-md">
                  <input name="parent_id" type="hidden">
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
                    <button type="button" class="btn btn-success" onclick="u$Grid.reload('unit_grid')">{{trans('Хайх')}}</button>
                    <button type="button" class="btn btn-warning" onclick="$('#unitSearch_Form')[0].reset()">{{trans('Арилгах')}}</button>
                    <button type="button" class="btn" onclick="u$Grid.toggleFilter(this)">{{trans('resource.buttons.close')}}</button>
                  </div>
                </div>
              </div>
            </div>
      			{{-- <div class="col-sm-6">
      				<div class="mb-md">
      					<button onclick="sysclients.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
      				</div>
      			</div> --}}
          </div>
          <div class="grid-body">
            <div style="display: none;" class="ucolumn-cont" data-table="unit_grid">
              <ucolumn name="index" source="index" utype="index" searchable="false" sortable="false"/>
              <ucolumn name="id" source="id" visible="false"/>
              <ucolumn name="name" source="name" sort="true"/>
              <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="sys.unit.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
              <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="sys.unit.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
            </div>
            <table action="/khc/unit/list" id="unit_grid" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>{{trans('resource.weblinks.id')}}</th>
                  <th>{{trans('resource.name')}}</th>
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
    buttons.push('<button onclick="sys.unit.add()" class="btn btn-primary fRight">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>');
    buttons.push('<button onclick="u$Grid.toggleFilter(this)" class="btn btn-info fRight">{{trans('Хайлт')}} <i class="fa fa-search"></i></button>');
    baseGridFunc.init("unit_grid", buttons, "unitSearch_Form");

  });

  sys.unit = {
      add: function(){
        var postData = {};
        postData["parent_id"] = $("#unitSearch_Form input[name='parent_id']").val();
        uPage.call('/khc/unit/update',postData);
      },

      edit: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;

          uPage.call('/khc/unit/update',postData);
      },

      save: function(){

          $.ajax({
              url: '/khc/unit/save',
              type: "POST",
              dataType: "json",
              data : $("#unitRegister_form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_unitRegister');
                    baseGridFunc.reload("unit_grid");
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
          postData['id'] = rowData.id;
          $.ajax({
              url: '/khc/unit/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("unit_grid");
                    $('#addressTree').jstree().delete_node([{
                        "id": data.data.id
                      }
                    ]);
                  }
              }
          });
        });
      }
  }

</script>
@endsection

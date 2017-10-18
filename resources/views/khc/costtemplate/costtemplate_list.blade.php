@extends('layouts.admin')

@section('content')
  <div id="window_costtemplateList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
      </div>

      <h2 class="panel-title">Зардалын загвар</h2>
    </header>
    <div class="panel-body">
      <div class="row gridFilterWrapper">
        <form id="costtemplateSearch_Form">
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

        </form>
        <div class="mb-md">
          <div class="form-group usticky" style="background: #fff;">
            <div class="col-md-12" style="text-align: center;">
              <div>
                <button type="button" class="btn btn-success" onclick="u$Grid.reload('costtemplate_grid')">{{trans('Хайх')}}</button>
                <button type="button" class="btn btn-warning" onclick="$('#costtemplateSearch_Form')[0].reset()">{{trans('Арилгах')}}</button>
                <button type="button" class="btn" onclick="u$Grid.toggleFilter(this)">{{trans('resource.buttons.close')}}</button>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-sm-6">
          <div class="mb-md">
            <button onclick="costtemplate.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
          </div>
        </div> --}}
      </div>
      <div class="grid-body">
        <div style="display: none;" class="ucolumn-cont" data-table="costtemplate_grid">
          <ucolumn width="10px" name="index" source="index" utype="index" searchable="false" sortable="false"/>
          <ucolumn name="cost_template_id" source="cost_template_id" sort="true" visible="false"/>
          <ucolumn width="20%" name="warehouse_name" source="warehouse_name" sort="true"/>
          <ucolumn name="amount" source="amount" sort="true"/>
          
          <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="costtemplate.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
          <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="costtemplate.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
        </div>
        <table action="/khc/costtemplate/data" id="costtemplate_grid" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Нэр</th>
              <th>{{trans('Дүн')}}</th>
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
    buttons.push('<button onclick="costtemplate.add()" class="btn btn-primary fRight">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>');
    buttons.push('<button onclick="u$Grid.toggleFilter(this)" class="btn btn-info fRight">{{trans('Хайлт')}} <i class="fa fa-search"></i></button>');
    baseGridFunc.init("costtemplate_grid", buttons, "costtemplateSearch_Form");

    $('.uselect2').select2();
  });

  var costtemplate = {
      add: function(){
        var postData = {};
        uPage.call('/khc/costtemplate/edit',postData);
      },

      edit: function(gridId ,elmnt){
          var rowData = baseGridFunc.getRowData(gridId ,elmnt);
          uPage.call('/khc/costtemplate/edit',{'cost_template_id' : rowData.cost_template_id});
      },

      save: function(){

          $.ajax({
              url: '/khc/costtemplate/save',
              type: "POST",
              dataType: "json",
              data : $("#costtemplateRegister_form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_costtemplateRegister');
                    baseGridFunc.reload("costtemplate_grid");
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
          postData['id'] = rowData.cost_template_id;
          $.ajax({
              url: '/khc/costtemplate/delete',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("costtemplate_grid");
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

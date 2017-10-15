@extends('layouts.admin')

@section('content')
<div id="window_externalList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.main.external')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="uexternal.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="external_grid">
        <ucolumn name="id" source="id" visible="false"></ucolumn>
        <ucolumn name="link" source="link"></ucolumn>
        <ucolumn name="count" source="count"></ucolumn>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="uexternal.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="uexternal.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="external/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="external_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.category.id')}}</th>
            <th>{{trans('resource.link')}}</th>
            <th>{{trans('resource.main.count')}}</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
      </table>
  	</div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {

      var buttons = [];
      // buttons.push('<button onclick="uexternal.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("external_grid", buttons);
  });

   var uexternal = {

        add: function(){
          var postData = {};
          uPage.call('external/index',postData);
        },

        edit: function(gridId ,elmnt){

            var rowData = baseGridFunc.getRowData(gridId ,elmnt);

            var postData = {};
            postData['isEdit'] = true;
            postData['id'] = rowData.id;

            uPage.call('external/index',postData);
        },

        save: function(){
            var data = $("#external_action_form").serializeObject();

            $.ajax({
                url: '/admin/external/save',
                type: "POST",
                dataType: "json",
                data : data,
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.saved);
                      uPage.close('window_externalIndex');
                      baseGridFunc.reload("external_grid");
                    }else{
                        uvalidate.setErrors(data);
                    }
                }
            });
        },

        remove: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;
          $.ajax({
              url: '/admin/external/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("external_grid");
                  }
              }
          });
        }

   }
</script>
  @endsection

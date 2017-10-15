@extends('layouts.admin')

@section('content')
<div id="window_filetypeList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.file.type')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="ufiletype.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="filetype_grid">
        <ucolumn name="ft_id" source="ft_id" visible="false"></ucolumn>
        <ucolumn name="source" source="source"></ucolumn>
        <ucolumn name="icon" source="icon" utype="formatter" func="ufiletype.iconFormatter"></ucolumn>
        <ucolumn name="active_flag" source="active_flag" utype="formatter" func="ufiletype.activeFlagFormatter"></ucolumn>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="ufiletype.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="ufiletype.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="filetype/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="filetype_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.category.id')}}</th>
            <th>{{trans('resource.category.name')}}</th>
            <th>{{trans('resource.main.icon')}}</th>
            <th>{{trans('resource.main.active')}} / {{trans('resource.main.deactive')}}</th>
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
      // buttons.push('<button onclick="ufiletype.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("filetype_grid", buttons);
  });

   var ufiletype = {

        add: function(){
          var postData = {};
          uPage.call('filetype/index',postData);
        },

        edit: function(gridId ,elmnt){

            var rowData = baseGridFunc.getRowData(gridId ,elmnt);

            var postData = {};
            postData['isEdit'] = true;
            postData['id'] = rowData.ft_id;

            uPage.call('filetype/index',postData);
        },

        save: function(){
            var data = $("#filetype_action_form").serializeObject();

            $.ajax({
                url: '/admin/filetype/save',
                type: "POST",
                dataType: "json",
                data : data,
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.saved);
                      uPage.close('window_filetypeIndex');
                      baseGridFunc.reload("filetype_grid");
                    }else{
                        uvalidate.setErrors(data);
                    }
                }
            });
        },

        remove: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.ft_id;
          $.ajax({
              url: '/admin/filetype/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("filetype_grid");
                  }
              }
          });
        },
        iconFormatter: function(data, type, row){
          var retVal = '<span class="'+ data +'" style="font-size: 20px; color: blue;"></span>';
          return retVal;
        },

        activeFlagFormatter: function(data, type, row){
          var retVal = "";

          if(data == 1){
            retVal = mainres.active;
          }else{
            retVal = mainres.deactive;
          }

          return retVal;
        }

   }
</script>
  @endsection

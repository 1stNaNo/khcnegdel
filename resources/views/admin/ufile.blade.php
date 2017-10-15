@extends('layouts.admin')

@section('content')
<div id="window_ufileList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.file.file')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="ufile.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="ufile_grid">
        <ucolumn name="id" source="id" visible="false"></ucolumn>
        <ucolumn name="title" source="title"></ucolumn>
        <ucolumn name="source" source="source"></ucolumn>
        <ucolumn name="number" source="number"></ucolumn>
        <ucolumn name="confirm_date" source="confirm_date"></ucolumn>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="ufile.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="ufile.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="file/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="ufile_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.category.id')}}</th>
            <th>{{trans('resource.file.type')}}</th>
            <th>{{trans('resource.category.name')}}</th>
            <th>{{trans('resource.main.number')}}</th>
            <th>{{trans('resource.main.confirm_date')}}</th>
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
      buttons.push('<button onclick="ufile.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("ufile_grid", buttons);
  });

   var ufile = {

        add: function(){
          var postData = {};
          uPage.call('file/index',postData);
        },

        edit: function(gridId ,elmnt){

            var rowData = baseGridFunc.getRowData(gridId ,elmnt);

            var postData = {};
            postData['isEdit'] = true;
            postData['id'] = rowData.id;

            uPage.call('file/index',postData);
        },

        save: function(){
            var data = $("#category_action_form").serializeObject();

            $.ajax({
                url: '/admin/file/save',
                type: "POST",
                dataType: "json",
                data : new FormData($("#ufile_action_form")[0]),
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.saved);
                      uPage.close('window_ufileIndex');
                      baseGridFunc.reload("ufile_grid");
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
              url: '/admin/file/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("ufile_grid");
                  }
              }
          });
        },
        urlFormatter: function(data, type, row){
          var retVal = "";

          if(data == "#$cat$#"){
              retVal = categoryres.news;
          }else{
            retVal = data;
          }

          return retVal;
        },

        targetFormatter: function(data, type, row){
            var retVal = "";

            if(data == "_self"){
              retVal = categoryres.self;
            }else{
              retVal = categoryres.blank;
            }

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

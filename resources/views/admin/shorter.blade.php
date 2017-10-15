@extends('layouts.admin')

@section('content')
<div id="window_shorterList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{ trans('resource.main.shorter') }}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="ushorter.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="shorter_grid">
        <ucolumn name="id" source="id" visible="false"/>
        <ucolumn name="source" source="source"/>
        <ucolumn name="url" source="url"/>
        <ucolumn name="target" source="target" utype="formatter" func="ushorter.formatTarget"/>
        <ucolumn name="show" source="show" utype="formatter" func="ushorter.formatStatus"/>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="ushorter.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="ushorter.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="shorter/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="shorter_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.category.id')}}</th>
            <th>{{trans('resource.category.name')}}</th>
            <th>{{trans('resource.category.link')}}</th>
            <th>{{trans('resource.category.target')}}</th>
            <th>{{trans('resource.poll.status')}}</th>
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
      // buttons.push('<button onclick="ushorter.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');
      // buttons.push('<button onclick="ucategory.remove()" class="btn btn-danger" style="margin-left:12px">{{trans('resource.buttons.remove')}}</button>');

      baseGridFunc.init("shorter_grid", buttons);
  });

   var ushorter = {

        add: function(){
          uPage.call('shorter/index',null);
        },

        edit: function(gridId ,elmnt){

            var rowData = baseGridFunc.getRowData(gridId ,elmnt);

            var postData = {};
            postData['isEdit'] = true;
            postData['id'] = rowData.id;
            if(postData['id'] != ""){
                uPage.call('shorter/index',postData);
            }
        },

        save: function(){
            var data = $("#shorter_action_form").serializeObject();

            $.ajax({
                url: '/admin/shorter/save',
                type: "POST",
                dataType: "json",
                data : data,
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.saved);
                      uPage.close('window_shorterIndex');
                      baseGridFunc.reload("shorter_grid");
                    }
                }
            });
        },

        remove: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;
          if(postData['id'] != ""){
              $.ajax({
                  url: '/admin/shorter/remove',
                  type: "POST",
                  dataType: "json",
                  data : postData,
                  success: function(data){
                      if(data.type == 'success'){
                        umsg.success(messages.removed);
                        baseGridFunc.reload("shorter_grid");
                      }
                  }
              });
          }
        },
        formatTarget : function(data, type, row){
          if(data == 'blank')
            return shorters.blank;
          else if(data == 'self')
            return shorters.self;
          else
            return "";
        },
        formatStatus : function(data, type, row){
          if(data == 1){
            return polls.active;
          }else if(data == 0){
            return polls.inactive;
          }else{
            return "";
          }
        },
   }
</script>
  @endsection

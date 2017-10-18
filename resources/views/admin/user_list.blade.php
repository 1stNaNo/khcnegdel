@extends('layouts.admin')

@section('content')
<div id="window_usersList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title"><span>{{trans('resource.users')}}</span></h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="uusers.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="users_grid">
        <ucolumn name="user_id" source="user_id" visible="false"/>
        <ucolumn name="name" source="name"/>
        <ucolumn name="firstname" source="firstname"/>
        <ucolumn name="lastname" source="lastname"/>
        <ucolumn name="email" source="email"/>
        <ucolumn name="phone" source="phone"/>
        <ucolumn name="warehouse_name" source="warehouse_name"/>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="uusers.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="uusers.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="userslist" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="users_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.weblinks.id')}}</th>
            <th>{{trans('Хэрэглэгчийн нэр')}}</th>
            <th>{{trans('Нэр')}}</th>
            <th>{{trans('Овог')}}</th>
            <th>{{trans('resource.email')}}</th>
            <th>{{trans('Утас')}}</th>
            <th>{{trans('Агуулах')}}</th>
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
    // buttons.push('<button onclick="uusers.add(); return false;" class="btn btn-primary pull-left" style="margin-left:12px" id="">{{trans('resource.buttons.add')}}</button>');
    baseGridFunc.init("users_grid", buttons);
  });

  var uusers = {
      add: function(){
        var postData = {};
        uPage.call('/admin/newuser',postData);
      },

      edit: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.user_id;

          uPage.call('/admin/newuser',postData);
      },

      save: function(){

          $.ajax({
              url: '/admin/usersave',
              type: "POST",
              dataType: "json",
              data : new FormData($("#userRegister_form")[0]),
              processData: false,  // tell jQuery not to process the data
              contentType: false,  // tell jQuery not to set contentType
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_userRegister');
                    baseGridFunc.reload("users_grid");
                  }else{
                    uvalidate.setErrors(data);
                  }
              }
          });
      },

      remove: function(gridId ,elmnt){

        var rowData = baseGridFunc.getRowData(gridId ,elmnt);

        var postData = {};
        postData['id'] = rowData.user_id;
        $.ajax({
            url: '/admin/userremove',
            type: "POST",
            dataType: "json",
            data : postData,
            success: function(data){
                if(data.type == 'success'){
                  umsg.success(messages.removed);
                  baseGridFunc.reload("users_grid");
                }
            }
        });
      }
  }

</script>
@endsection

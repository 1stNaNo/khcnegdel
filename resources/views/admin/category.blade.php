@extends('layouts.admin')

@section('content')
<div id="window_categoryList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.category.title')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="ucategory.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="category_grid">
        <ucolumn name="ca_id" source="ca_id" visible="false"></ucolumn>
        <ucolumn name="p_title" source="p_title"></ucolumn>
        <ucolumn name="source" source="source"></ucolumn>
        <ucolumn name="url" source="url" utype="formatter" func="ucategory.urlFormatter"></ucolumn>
        <ucolumn name="target" source="target" utype="formatter" func="ucategory.targetFormatter"></ucolumn>
        <ucolumn name="active_flag" source="active_flag" utype="formatter" func="ucategory.activeFlagFormatter"></ucolumn>
        <ucolumn name="order_num" source="order_num"</ucolumn>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="ucategory.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="ucategory.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="datatables.data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="category_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.category.id')}}</th>
            <th>{{trans('resource.category.parent')}}</th>
            <th>{{trans('resource.category.name')}}</th>
            <th>{{trans('resource.category.link')}}</th>
            <th>{{trans('resource.category.action')}}</th>
            <th>{{trans('resource.main.active')}} / {{trans('resource.main.deactive')}}</th>
            <th>{{trans('resource.category.order')}}</th>
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
      // buttons.push('<button onclick="ucategory.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("category_grid", buttons);
  });

   var ucategory = {

        add: function(){
          var postData = {};
          uPage.call('category/index',postData);
        },

        edit: function(gridId ,elmnt){

            var rowData = baseGridFunc.getRowData(gridId ,elmnt);

            var postData = {};
            postData['isEdit'] = true;
            postData['id'] = rowData.ca_id;

            uPage.call('category/index',postData);
        },

        save: function(){
            var data = $("#category_action_form").serializeObject();

            $.ajax({
                url: '/admin/category/save',
                type: "POST",
                dataType: "json",
                data : data,
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.saved);
                      uPage.close('window_categoryIndex');
                      baseGridFunc.reload("category_grid");
                    }else{
                        uvalidate.setErrors(data);
                    }
                }
            });
        },

        remove: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.ca_id;
          $.ajax({
              url: '/admin/category/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("category_grid");
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

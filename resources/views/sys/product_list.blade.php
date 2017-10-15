@extends('layouts.admin')

@section('content')
<div id="window_productList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{ trans('Бараа бүтээгдхүүн') }}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="sysproduct.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="product_grid">
        <ucolumn name="id" source="id" visible="false"/>
        <ucolumn name="name" source="name"/>
        <ucolumn name="cat_name" source="cat_name"/>
        <ucolumn name="split" source="split"/>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="sysproduct.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="sysproduct.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="/sys/product/list" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="product_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.weblinks.id')}}</th>
            <th>{{trans('resource.name')}}</th>
            <th>{{trans('Төрөл')}}</th>
            <th>{{trans('Хувааж болох эсэх')}}</th>
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
    // buttons.push('<button onclick="sysproduct.add(); return false;" class="btn btn-primary pull-left" style="margin-left:12px" id="">{{trans('resource.buttons.add')}}</button>');
    baseGridFunc.init("product_grid", buttons);
  });

  var sysproduct = {
      add: function(){
        var postData = {};
        uPage.call('/sys/product/edit',postData);
      },

      edit: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;

          uPage.call('/sys/product/edit',postData);
      },

      save: function(){
          var postData = $("#productRegister_form").serializeObject();
          postData["unit"] = $("select[name='unit']").val();

          $.ajax({
              url: '/sys/product/save',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_productRegister');
                    baseGridFunc.reload("product_grid");
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
            url: '/sys/product/remove',
            type: "POST",
            dataType: "json",
            data : postData,
            success: function(data){
                if(data.type == 'success'){
                  umsg.success(messages.removed);
                  baseGridFunc.reload("product_grid");
                }
            }
        });
      }
  }

</script>
@endsection

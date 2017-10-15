@extends('layouts.admin')

@section('content')
<div id="window_bannerList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.banner.banner')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="ubanner.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="banner_grid">
        <ucolumn name="banner_id" source="banner_id" visible="false"></ucolumn>
        <ucolumn name="value" source="value" utype="formatter" func="ubanner.valueFormatter"></ucolumn>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="ubanner.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="ubanner.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="banner/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="banner_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.category.id')}}</th>
            <th>{{trans('resource.weblinks.img')}}</th>
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
      // buttons.push('<button onclick="ubanner.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("banner_grid", buttons);
  });

   var ubanner = {

        add: function(){
          var postData = {};
          uPage.call('banner/index',postData);
        },

        edit: function(gridId ,elmnt){

            var rowData = baseGridFunc.getRowData(gridId ,elmnt);

            var postData = {};
            postData['isEdit'] = true;
            postData['id'] = rowData.banner_id;

            uPage.call('banner/index',postData);
        },

        save: function(){

            $.ajax({
                url: '/admin/banner/save',
                type: "POST",
                dataType: "json",
                data : new FormData($("#bannerRegister_form")[0]),
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.saved);
                      uPage.close('window_bannerRegister');
                      baseGridFunc.reload("banner_grid");
                    }else{
                        uvalidate.setErrors(data);
                    }
                }
            });
        },

        remove: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.banner_id;
          $.ajax({
              url: '/admin/banner/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("banner_grid");
                  }
              }
          });
        },
        valueFormatter: function(data, type, row){
          var retVal = '<img src="'+ data +'" style="width: 325px; height: 78px;"/>';

          return retVal;
        }

   }
</script>
  @endsection

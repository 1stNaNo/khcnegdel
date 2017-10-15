@extends('layouts.admin')

@section('content')
<div id="window_weblinkList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.weblinks.addweblink')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="uweblinks.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="weblinks_grid">
        <ucolumn name="id" source="id" visible="false"/>
        <ucolumn name="category_id" source="category_id" utype="formatter" func="uweblinks.categoryFormatter"/>
        <ucolumn name="source" source="source"/>
        <ucolumn name="link" source="link"/>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="uweblinks.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="uweblinks.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="weblinklist" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="weblinks_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.weblinks.id')}}</th>
            <th>{{trans('resource.weblinks.category')}}</th>
            <th>{{trans('resource.weblinks.title')}}</th>
            <th>{{trans('resource.weblinks.link')}}</th>
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
    buttons.push('<button onclick="addWeblink(false); return false;" class="btn btn-primary pull-left" style="margin-left:12px" id="">{{trans('resource.buttons.add')}}</button>');

    baseGridFunc.init("weblinks_grid", buttons);
  });

  var uweblinks = {
      add: function(){
        var postData = {};
        uPage.call('weblinkregister',postData);
      },

      edit: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['isEdit'] = true;
          postData['id'] = rowData.id;

          uPage.call('weblinkregister',postData);
      },

      save: function(){

          $.ajax({
              url: 'weblinksave',
              type: "POST",
              dataType: "json",
              data : new FormData($("#weblinkRegister_form")[0]),
              processData: false,  // tell jQuery not to process the data
              contentType: false,  // tell jQuery not to set contentType
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_weblinkRegister');
                    baseGridFunc.reload("weblinks_grid");
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
            url: 'weblinkremove',
            type: "POST",
            dataType: "json",
            data : postData,
            success: function(data){
                if(data.type == 'success'){
                  umsg.success(messages.removed);
                  baseGridFunc.reload("weblinks_grid");
                }
            }
        });
      },
      categoryFormatter: function(data, type, row){
        var retVal = "";

        if(data == 1){
            retVal = weblinkres.sums;
        }else if(data == 2){
          retVal = weblinkres.agency;
        }else{
          retVal = weblinkres.others;
        }

        return retVal;
      },
  }

</script>
@endsection

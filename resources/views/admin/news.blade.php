@extends('layouts.admin')

@section('content')
<div id="window_newsList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.news.title')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="unews.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
        <div style="display: none;" class="ucolumn-cont" data-table="news_grid">
          <ucolumn name="id" source="id" visible="false"/>
          <ucolumn name="title" source="title"/>
          <ucolumn name="ca_title" source="ca_title"/>
          <ucolumn name="comment_count" source="comment_count"/>
          <ucolumn name="views" source="views"/>
          <ucolumn name="insert_date" source="insert_date"/>
          <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="unews.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
          <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="unews.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
        </div>

        <table action="news/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="news_grid" width="100%">
          <thead>
            <tr>
              <th>{{trans('resource.category.id')}}</th>
              <th>{{trans('resource.news.ntitle')}}</th>
              <th>{{trans('resource.category.title')}}</th>
              <th>{{trans('resource.news.comment')}}</th>
              <th>{{trans('resource.news.views')}}</th>
              <th>{{trans('resource.main.insert_date')}}</th>
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
        // buttons.push('<button onclick="unews.add()" class="btn btn-primary" style="margin-left:12px"></button>');

        baseGridFunc.init("news_grid", buttons);
    });

     var unews = {

          add: function(){
            var postData = {};
            uPage.call('news/index',postData);
          },

          edit: function(gridId ,elmnt){

              var rowData = baseGridFunc.getRowData(gridId ,elmnt);

              var postData = {};
              postData['isEdit'] = true;
              postData['id'] = rowData.id;

              uPage.call('news/index',postData);
          },

          save: function(){
              var data = $("#news_action_form").serializeObject();
              data['content'] = {}

              $("usource").find("item").each(function(){
                  var tmpVal = $("#content_"+ $(this).attr('name')).summernote("code");
                  if(tmpVal == "<br>"){
                    tmpVal = "";
                  }
                  data['content'][$(this).attr('name')] = tmpVal;
              });

              $.ajax({
                  url: '/admin/news/save',
                  type: "POST",
                  dataType: "json",
                  data : data,
                  success: function(data){
                      if(data.type == 'success'){
                        umsg.success(messages.saved);
                        uPage.close('window_newsIndex');
                        baseGridFunc.reload("news_grid");
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
                url: '/admin/news/remove',
                type: "POST",
                dataType: "json",
                data : postData,
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.removed);
                      baseGridFunc.reload("news_grid");
                    }
                }
            });
          }
     }
  </script>
@endsection

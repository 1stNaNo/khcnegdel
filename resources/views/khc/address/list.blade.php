@extends((Request::get('modal') == 0) ? 'layouts.admin' : 'layouts.only')

@section('content')
<div id="window_addressList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{ trans('Хаяг') }}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
        <div class="col-md-3">
          <div id="addressTree">

          </div>
        </div>
        <div class="col-md-9">
          <div class="row gridFilterWrapper">
            <form id="addressSearch_Form">
            <div class="col-sm-4">
              <div class="mb-md">
                  <input name="parent_id" type="hidden">
                  <div class="form-group">
                    <label class="col-md-12 control-label">{{trans('resource.name')}} :</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" name="name"/>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-md">
                  <input name="parent_id" type="hidden">
                  <div class="form-group">
                    <label class="col-md-12 control-label">{{trans('Код')}} :</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" name="code"/>
                    </div>
                  </div>
              </div>
            </div>
            </form>
            <div class="mb-md">
              <div class="form-group usticky" style="background: #fff;">
                <div class="col-md-12" style="text-align: center;">
                  <div>
                    <button type="button" class="btn btn-success" onclick="u$Grid.reload('address_grid')">{{trans('Хайх')}}</button>
                    <button type="button" class="btn btn-warning" onclick="$('#addressSearch_Form')[0].reset()">{{trans('Арилгах')}}</button>
                    <button type="button" class="btn" onclick="u$Grid.toggleFilter(this)">{{trans('resource.buttons.close')}}</button>
                  </div>
                </div>
              </div>
            </div>
      			{{-- <div class="col-sm-6">
      				<div class="mb-md">
      					<button onclick="sysclients.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
      				</div>
      			</div> --}}
          </div>
          <div class="grid-body">
            <div style="display: none;" class="ucolumn-cont" data-table="address_grid">
              <ucolumn name="index" source="index" utype="index" searchable="false" sortable="false"/>
              <ucolumn name="id" source="id" visible="false"/>
              <ucolumn name="name" source="name" sort="true"/>
              <ucolumn name="code" source="code"/>
              <ucolumn name="parent_name" source="parent_name"/>
              <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="sys.address.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
              <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="sys.address.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
            </div>
            <table action="/khc/address/list" id="address_grid" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>{{trans('resource.weblinks.id')}}</th>
                  <th>{{trans('resource.name')}}</th>
                  <th>{{trans('Код')}}</th>
                  <th>{{trans('Хамаарал')}}</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
  	</div>
  </section>
</div>
<script type="text/javascript">

  sys.address = {
      add: function(){
        var postData = {};
        postData["parent_id"] = $("#addressSearch_Form input[name='parent_id']").val();
        uPage.call('/khc/address/update',postData);
      },

      edit: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;

          uPage.call('/khc/address/update',postData);
      },

      save: function(){

          $.ajax({
              url: '/khc/address/save',
              type: "POST",
              dataType: "json",
              data : $("#addressRegister_Form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_addressRegister');
                    baseGridFunc.reload("address_grid");

                    $('#addressTree').jstree().delete_node([{
                        "id": data.data.id
                      }
                    ]);

                    var parent_id = "#"

                    if(data.data.parent_id != 0){
                      parent_id = data.data.parent_id;
                    }

                    $('#addressTree').jstree().create_node(parent_id, {
                      "id": data.data.id,
                      "text": data.data.name,
                      "type": data.data.type,
                      "children": true,
                    },"last", function(){});
                  }else{
                    uvalidate.setErrors(data);
                  }
              }
          });
      },

      remove: function(gridId ,elmnt){
        uModal.remove(function(){
          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;
          $.ajax({
              url: '/khc/address/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.removed);
                    baseGridFunc.reload("address_grid");
                    $('#addressTree').jstree().delete_node([{
                        "id": data.data.id
                      }
                    ]);
                  }
              }
          });
        });
      },

      treeMenu : function(node){
        var items = {
            'new' : {
                'label' : system.new,
                'icon': 'fa fa-plus',
                'action' : function () {
                  var postData = {};
                  postData["parent_id"] = node.id;
                  uPage.call('/khc/address/update',postData);
                 }
            },
            'edit' : {
              'label' : system.edit,
              'icon': 'fa fa-pencil',
              'action' : function () {
                var postData = {};
                postData["id"] = node.id;
                uPage.call('/khc/address/update',postData);
               }
            },
            'delete' : {
              'label' : system.delete,
              'icon': 'fa fa-close',
              'action' : function(){
                uModal.remove(function(){
                  var postData = {};
                  postData['id'] = node.id;
                  $.ajax({
                      url: '/khc/address/remove',
                      type: "POST",
                      dataType: "json",
                      data : postData,
                      success: function(data){
                          if(data.type == 'success'){
                            umsg.success(messages.removed);
                            baseGridFunc.reload("address_grid");
                            $('#addressTree').jstree().delete_node([{
                                "id": data.data.id
                              }
                            ]);
                          }
                      }
                  });
                });
              }
            }

        }

        return items;
      }
  }

  $(document).ready(function() {
    var buttons = [];
    buttons.push('<button onclick="sys.address.add()" class="btn btn-primary fRight">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>');
    buttons.push('<button onclick="u$Grid.toggleFilter(this)" class="btn btn-info fRight">{{trans('Хайлт')}} <i class="fa fa-search"></i></button>');
    baseGridFunc.init("address_grid", buttons, "addressSearch_Form");


    $('#addressTree').jstree({
  		'core' : {
  			'themes' : {
  				'responsive': false
  			},
        'data' : {
            'url' : function (node) {
              return node.id === '#' ?
                '/khc/address/tree' :
                '/khc/address/tree/node';
            },
            'data' : function (node) {
              return { 'id' : node.id };
            }
        },
        check_callback : true
  		},
  		'types' : {
  			'default' : {
  				'icon' : 'fa fa-location-arrow'
  			},
  			'country' : {
  				'icon' : 'fa fa-globe'
  			},
        'city' : {
  				'icon' : 'fa fa-flag'
  			},
        'district' : {
  				'icon' : 'fa fa-building'
  			}
  		},
  		'contextmenu': {'items': sys.address.treeMenu},
  		'plugins': ['types','contextmenu']
  	});

    $('#addressTree').on("select_node.jstree", function (e, data) {

        var nodeId = "";
        if(data.node.id != 0){
          nodeId = data.node.id;
        }

        $("#addressSearch_Form input[name='parent_id']").val(nodeId);
        u$Grid.reload('address_grid');
    });

  });

</script>
@endsection

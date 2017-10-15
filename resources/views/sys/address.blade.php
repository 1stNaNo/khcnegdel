@extends('layouts.admin')

@section('content')
<div id="window_clientsList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{ trans('resource.sys.company') }}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
        <div class="col-md-3">
          <div id="addressTree">

          </div>
        </div>
        <div class="col-md-9">
          <div class="row gridFilterWrapper">
            <div class="col-sm-4">
              <div class="mb-md">
                <form id="addressSearch_Form">
                  <input name="parent_id" type="hidden">
                  <div class="form-group">
                    <label class="col-md-12 control-label">{{trans('resource.name')}} :</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" name="name"/>
                    </div>
                  </div>
                </form>
              </div>
            </div>
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
              <ucolumn name="parent_id" source="parent_id"/>
              <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="sysclients.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
              <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="sysclients.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
            </div>
            <table action="/sys/address/list" id="address_grid" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th>{{trans('resource.weblinks.id')}}</th>
                  <th>{{trans('resource.name')}}</th>
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
                '/sys/address/tree' :
                '/sys/address/tree/node';
            },
            'data' : function (node) {
              return { 'id' : node.id };
            }
          }
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

  sys.address = {
      add: function(){
        var postData = {};
        uPage.call('/sys/clients/edit',postData);
      },

      edit: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;

          uPage.call('/sys/clients/edit',postData);
      },

      save: function(){

          $.ajax({
              url: '/sys/clients/save',
              type: "POST",
              dataType: "json",
              data : $("#clientsRegister_form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_clientsRegister');
                    baseGridFunc.reload("clients_grid");
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
            url: '/sys/clients/remove',
            type: "POST",
            dataType: "json",
            data : postData,
            success: function(data){
                if(data.type == 'success'){
                  umsg.success(messages.removed);
                  baseGridFunc.reload("clients_grid");
                }
            }
        });
      },

      treeMenu : function(node){
        var items = {
            'new' : {
                'label' : system.new,
                'icon': 'fa fa-plus',
                'action' : function () { console.log(node); }
            },
            'edit' : {
                'label' : system.edit,
                'icon': 'fa fa-pencil',
                'action' : function () { alert(2); }
            },
            'delete' : {
                'label' : system.delete,
                'icon': 'fa fa-close',
                'action' : function () { alert(2); }
            }

        }

        return items;
      }
  }

</script>
@endsection

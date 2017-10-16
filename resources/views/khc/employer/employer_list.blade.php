@extends('layouts.admin')

@section('content')
  <div id="window_employerList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
      </div>

      <h2 class="panel-title">Ажилтан</h2>
    </header>
    <div class="panel-body">
      <div class="row gridFilterWrapper">
        <form id="employerSearch_Form">
          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('resource.name')}} :</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="firstname"/>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Овог')}} :</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="lastname"/>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Утас')}} :</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="phone"/>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Улс')}} :</label>
                <div class="col-md-12">
                  <select name="country_id" class="uselect2" style="width : 100%" onchange="changeSelectValue('window_employerList', $('[name=city_id]'), $(this).val());">
                    <option value="">Сонго</option>
                    @foreach($countries as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Хот')}} :</label>
                <div class="col-md-12">
                  <select name="city_id" class="uselect2" style="width : 100%" onchange="changeSelectValue('window_employerList', $('[name=district_id]'), $(this).val());">
                    <option value="">Сонго</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Сум/Дүүрэг')}} :</label>
                <div class="col-md-12">
                  <select name="district_id" class="uselect2" style="width : 100%">
                    <option value="">Сонго</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="mb-md">
              <div class="form-group">
                <label class="col-md-12 control-label">{{trans('Агуулах')}} :</label>
                <div class="col-md-12">
                  <select name="wh_id" class="uselect2" style="width : 100%">
                    <option value="">Сонго</option>
                    @foreach($warehouses as $c)
                      <option value="{{$c->wh_id}}">{{$c->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>

        </form>   
        <div class="mb-md">
          <div class="form-group usticky" style="background: #fff;">
            <div class="col-md-12" style="text-align: center;">
              <div>
                <button type="button" class="btn btn-success" onclick="u$Grid.reload('employer_grid')">{{trans('Хайх')}}</button>
                <button type="button" class="btn btn-warning" onclick="$('#employerSearch_Form')[0].reset()">{{trans('Арилгах')}}</button>
                <button type="button" class="btn" onclick="u$Grid.toggleFilter(this)">{{trans('resource.buttons.close')}}</button>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-sm-6">
          <div class="mb-md">
            <button onclick="employer.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
          </div>
        </div> --}}
      </div>
      <div class="grid-body">
        <div style="display: none;" class="ucolumn-cont" data-table="employer_grid">
          <ucolumn name="index" source="index" utype="index" searchable="false" sortable="false"/>
          <ucolumn name="emp_id" source="emp_id" sort="true" visible="false"/>
          <ucolumn name="lastname" source="lastname" sort="true"/>
          <ucolumn name="firstname" source="firstname" sort="true"/>
          <ucolumn name="gender_name" source="gender_name" sort="true"/>
          <ucolumn name="warehouse_name" source="warehouse_name" sort="true"/>
          <ucolumn name="country_name" source="country_name" sort="true"/>
          <ucolumn name="city_name" source="city_name" sort="true"/>
          <ucolumn name="district_name" source="district_name" sort="true"/>
          <ucolumn name="address" source="address" sort="true"/>
          <ucolumn name="phone" source="phone" sort="true"/>
          <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="employer.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
          <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="employer.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
        </div>
        <table action="/khc/employer/data" id="employer_grid" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Овог</th>
              <th>Нэр</th>
              <th>Хүйс</th>
              <th>Агуулах</th>
              <th>{{trans('Улс')}}</th>
              <th>{{trans('Аймаг/хот')}}</th>
              <th>{{trans('Сум/дүүрэг')}}</th>
              <th>{{trans('Хаяг')}}</th>
              <th>{{trans('Утас')}}</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var buttons = [];
    $(".uselect2").select2();
    buttons.push('<button onclick="employer.add()" class="btn btn-primary fRight">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>');
    buttons.push('<button onclick="u$Grid.toggleFilter(this)" class="btn btn-info fRight">{{trans('Хайлт')}} <i class="fa fa-search"></i></button>');
    baseGridFunc.init("employer_grid", buttons, "employerSearch_Form");
  });

  var employer = {
      add: function(){
        var postData = {};
        uPage.call('/khc/employer/edit',postData);
      },

      edit: function(gridId ,elmnt){
          var rowData = baseGridFunc.getRowData(gridId ,elmnt);
          uPage.call('/khc/employer/edit',{'id' : rowData.emp_id});
      },

      save: function(){

          $.ajax({
              url: '/khc/employer/save',
              type: "POST",
              dataType: "json",
              data : $("#employerRegister_form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_employerRegister');
                    baseGridFunc.reload("employer_grid");
                  }else{
                    uvalidate.setErrors(data);
                  }
              }
          });
      },

      remove: function(gridId ,elmnt){

        var rowData = baseGridFunc.getRowData(gridId ,elmnt);

        var postData = {};
        postData['emp_id'] = rowData.emp_id;
        $.ajax({
            url: '/khc/employer/delete',
            type: "POST",
            dataType: "json",
            data : postData,
            success: function(data){
                if(data.type == 'success'){
                  umsg.success(messages.removed);
                  baseGridFunc.reload("employer_grid");
                }
            }
        });
      },
      isCentre : function(data, type, row){
        if(row.is_centre == 1){
          return 'Тийм';
        }else{
          return 'Үгүй';
        }
      }
  }

</script>
@endsection

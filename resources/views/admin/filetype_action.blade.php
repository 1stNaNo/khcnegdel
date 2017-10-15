<div id="window_filetypeIndex" class="page-window">
    <input type="hidden" class="prev_window"/>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">{{trans('resource.file.type')}}</h2>
              </header>
              <div class="panel-body">
                <form action="" id="filetype_action_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                  <input type="hidden" name="id" value="{{ (count($vw_filetype) > 0) ? $vw_filetype->ft_id : '' }}"/>

                  @foreach($langs as $item)
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('resource.category.name')}} {{$item->lang_name}}</label>
                      <div class="col-md-6">
                        <input class="form-control " type="text" value="{{ (count($source->get($item->lang_key)) > 0) ? $source->get($item->lang_key)->source : '' }}" name="title[{{$item->lang_key}}]">
                      </div>
                    </div>
                  @endforeach
                  <div class="form-group" id="linkCont">
                    <label class="col-md-3 control-label">{{trans('resource.main.icon')}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (count($vw_filetype) > 0) ? $vw_filetype->icon: ''}}" name="icon">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.main.active')}} / {{trans('resource.main.deactive')}}</label>
                    <div class="col-md-6">
                      <select id="active_flag" name="active_flag" class="uselect2" style="width:100%">
                        @if(count($vw_filetype) > 0)
                          @if($vw_filetype->active_flag == 0)
                            <option value="1">{{trans('resource.main.active')}}</option>
                            <option selected="selected" value="0">{{trans('resource.main.deactive')}}</option>
                          @else
                            <option selected="selected" value="1">{{trans('resource.main.active')}}</option>
                            <option value="0">{{trans('resource.main.deactive')}}</option>
                          @endif
                        @else
                          <option selected="selected" value="1">{{trans('resource.main.active')}}</option>
                          <option value="0">{{trans('resource.main.deactive')}}</option>
                        @endif
                      </select>
                    </div>
                  </div>


                  <div class="form-group usticky" style="background: #fff;">
                    <div class="col-md-12">
                      <div style="float: right;">
                        <button type="button" class="btn btn-primary" onclick="ufiletype.save();">{{trans('resource.buttons.save')}}</button>
                        <button type="button" class="btn" onclick="uPage.close('window_filetypeIndex')">{{trans('resource.buttons.close')}}</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </section>
        </div>
    </div>
      <script type="text/javascript">
          $(document).ready(function(){

            $(".uselect2").select2();

            $("#linkAction").change(function(){
                if($(this).val() == "#$cat$#"){
                    $("#linkCont").hide();
                    $("input[name='link']").val($(this).val());
                }else{
                  $("#linkCont").show();
                  $("input[name='link']").val($(this).val());
                }
            });

          });
      </script>
</div>

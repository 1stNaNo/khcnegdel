<div id="window_categoryIndex" class="page-window">
    <input type="hidden" class="prev_window"/>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">{{trans('resource.news.title')}}</h2>
              </header>
              <div class="panel-body">
                <form action="" id="category_action_form" class="form-horizontal form-bordered">
                  <input type="hidden" name="id" value="{{ (count($vw_category) > 0) ? $vw_category->ca_id : '' }}"/>
                  @foreach($langs as $item)
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('resource.news.ntitle')}} {{$item->lang_name}}</label>
                      <div class="col-md-6">
                        <input class="form-control" type="text" value="{{ (count($source->get($item->lang_key)) > 0) ? $source->get($item->lang_key)->source : '' }}" name="title[{{$item->lang_key}}]">
                      </div>
                    </div>
                  @endforeach
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.parent')}}</label>
                    <div class="col-md-6">
                      <select id="parent" name="parent" class="uselect2" style="width:100%">
                        <option value="0"></option>
                        @foreach($category as $item)
                            @if(count($vw_category) > 0)
                                @if($item->ca_id == $vw_category->parent_id)
                                    <option selected="selected" value="{{$item->ca_id}}">{{$item->source}}</option>
                                @else
                                    <option value="{{$item->ca_id}}">{{$item->source}}</option>
                                @endif
                            @else
                                <option value="{{$item->ca_id}}">{{$item->source}}</option>
                            @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.target')}}</label>
                    <div class="col-md-6">
                      <select id="linkAction" name="action" class="uselect2" style="width:100%">
                          @if(count($vw_category) > 0)
                              @if($vw_category->url == '#$cat$#')
                                <option selected="selected" value="#$cat$#">{{trans('resource.news.title')}}</option>
                                <option value="">{{trans('resource.weblinks.link')}}</option>
                              @else
                                <option value="#$cat$#">{{trans('resource.news.title')}}</option>
                                <option selected="selected" value="">{{trans('resource.weblinks.link')}}</option>
                              @endif
                          @else
                            <option selected="selected" value="#$cat$#">{{trans('resource.news.title')}}</option>
                            <option value="">{{trans('resource.weblinks.link')}}</option>
                          @endif
                      </select>
                    </div>
                  </div>
                  @if(count($vw_category) > 0)
                      @if($vw_category->url == '#$cat$#')
                        <div class="form-group" style="display:none;" id="linkCont">
                      @else
                        <div class="form-group" id="linkCont">
                      @endif
                  @else
                      <div class="form-group" style="display:none;" id="linkCont">
                  @endif
                    <label class="col-md-3 control-label">{{trans('resource.category.link')}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (count($vw_category) > 0) ? $vw_category->url: ''}}" name="link">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.action')}}</label>
                    <div class="col-md-6">
                      <select id="target" name="target" class="uselect2" style="width:100%">
                          @if(count($vw_category) > 0)
                              @if($vw_category->target == '_self')
                                <option selected="selected" value="_self">{{trans('resource.category.self')}}</option>
                                <option value="_blank">{{trans('resource.category.blank')}}</option>
                              @else
                                <option value="_self">{{trans('resource.category.self')}}</option>
                                <option selected="selected" value="_blank">{{trans('resource.category.blank')}}</option>
                              @endif
                          @else
                            <option selected="selected" value="_self">{{trans('resource.category.self')}}</option>
                            <option value="_blank">{{trans('resource.category.blank')}}</option>
                          @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.publish')}}</label>
                    <div class="col-md-6">
                      <div class="checkbox check-default checkbox-circle">
                          @if(count($vw_category) > 0)
                            @if($vw_category->show_menu == 1)
                                <input style="margin-left: 0" id="checkbox7" name="showmenu" value="1" checked="checked" type="checkbox">
                            @else
                              <input style="margin-left: 0" id="checkbox7" name="showmenu" value="1" type="checkbox">
                            @endif
                          @else
                              <input style="margin-left: 0" id="checkbox7" name="showmenu" value="1" checked="checked" type="checkbox">
                          @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.main.active')}} / {{trans('resource.main.deactive')}}</label>
                    <div class="col-md-6">
                      <select id="active" name="active" class="uselect2" style="width:100%">
                        @if(count($vw_category) > 0)
                          @if($vw_category->active_flag == 0)
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
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.category.order')}} {{$item->lang_name}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (count($vw_category) > 0) ? $vw_category->order_num: ''}}" name="order_num">
                    </div>
                  </div>
                  <div class="form-group usticky" style="background: #fff;">
                    <div class="col-md-12">
                      <div style="float: right;">
                        <button type="button" class="btn btn-primary" onclick="ucategory.save();">{{trans('resource.buttons.save')}}</button>
                        <button type="button" class="btn" onclick="uPage.close('window_categoryIndex')">{{trans('resource.buttons.close')}}</button>
                      </div>
                    </div>
                  </div>
                </form>
                <usource style="display: none;">
                  @foreach ($langs as $item)
                      <item name='{!! $item->lang_key !!}'>{!! (count($source->get($item->lang_key)) > 0) ? $source->get($item->lang_key)->source : '' !!}</item>
                  @endforeach
                </usource>
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
</div>

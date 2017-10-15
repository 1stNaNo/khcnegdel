<div id="window_ufileIndex" class="page-window">
    <input type="hidden" class="prev_window"/>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">{{trans('resource.file.file')}}</h2>
              </header>
              <div class="panel-body">
                <form action="" id="ufile_action_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                  <input type="hidden" name="id" value="{{ (count($vw_ufile) > 0) ? $vw_ufile->id : '' }}"/>

                  @foreach($langs as $item)
                    <div class="form-group">
                      <label class="col-md-3 control-label">{{trans('resource.category.name')}} {{$item->lang_name}}</label>
                      <div class="col-md-6">
                        <input class="form-control " type="text" value="{{ (count($source->get($item->lang_key)) > 0) ? $source->get($item->lang_key)->source : '' }}" name="name[{{$item->lang_key}}]">
                      </div>
                    </div>
                  @endforeach
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.file.type')}}</label>
                    <div class="col-md-6">
                      <select name="type_id" class="uselect2" style="width:100%">
                        @foreach($vw_filetype as $item)
                            @if(count($vw_ufile) > 0)
                                @if($item->ft_id == $vw_ufile->type_id)
                                    <option selected="selected" value="{{$item->ft_id}}">{{$item->source}}</option>
                                @else
                                    <option value="{{$item->ft_id}}">{{$item->source}}</option>
                                @endif
                            @else
                                <option value="{{$item->ft_id}}">{{$item->source}}</option>
                            @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.main.number')}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (count($vw_ufile) > 0) ? $vw_ufile->number: ''}}" name="number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.main.confirm_date')}}</label>
                    <div class="col-md-6">
                      <input class="form-control " type="text" value="{{ (count($vw_ufile) > 0) ? $vw_ufile->confirm_date: ''}}" name="confirm_date">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('resource.file.file')}}</label>
                    <div class="col-md-6">
                      @if(count($vw_ufile) > 0)
                          <a href="{{$vw_ufile->path}}" target="_blank">{{trans('resource.file.show')}}</a>
                      @endif
                      <input type="hidden" name="img_hidden" value="{{ (count($vw_ufile) > 0) ? $vw_ufile->path : '' }}"/>
                      <input type="file" name="img"/>
                    </div>
                  </div>

                  <div class="form-group usticky" style="background: #fff;">
                    <div class="col-md-12">
                      <div style="float: right;">
                        <button type="button" class="btn btn-primary" onclick="ufile.save();">{{trans('resource.buttons.save')}}</button>
                        <button type="button" class="btn" onclick="uPage.close('window_ufileIndex')">{{trans('resource.buttons.close')}}</button>
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

          });
      </script>
</div>

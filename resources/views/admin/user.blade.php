
<div id="window_userRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.users')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="userRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="id" value="{{ (!empty($user)) ? $user->user_id : '' }}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Хэрэглэгчийн нэр')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="name" class="" value="{{(!empty($user)) ? $user->name : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Овог')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="lastname" class="" value="{{(!empty($user)) ? $user->lastname : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Нэр')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="firstname" class="" value="{{(!empty($user)) ? $user->firstname : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Утас')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="phone" class="" value="{{(!empty($user)) ? $user->phone : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.email')}}</label>
                  <div class="col-md-6">
                    @if(!empty($user->user_id))
                      <input readonly type="text" class="form-control" name="email" class="" value="{{(!empty($user)) ? $user->email : ''}}"/>
                    @else
                      <input type="text" class="form-control" name="email" class="" value="{{(!empty($user)) ? $user->email : ''}}"/>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.password')}}</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="password" class=""/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.passwordconf')}}</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="password_confirmation" class=""/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Агуулах')}}</label>
                  <div class="col-md-6">
                    <select name="wh_id">
                      @foreach($warehouses as $c)
                        @if($user->wh_id == $c->wh_id)
                          <option selected="selected" value="{{$c->wh_id}}">{{$c->name}}</option>
                        @else
                          <option value="{{$c->wh_id}}">{{$c->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.category.parent')}}</label>
                  <span class="help"></span>
                  <div class="col-md-6">
                    <select id="role" name="role" class="uselect2" style="width:100%">
                      @foreach($roles as $item)
                          @if($item->name != "developer")
                            @if(count($user) > 0)
                                @if($user->hasRole([$item->name]))
                                    <option selected="selected" value="{{$item->id}}">{{$item->display_name}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->display_name}}</option>
                                @endif
                            @else
                                <option value="{{$item->id}}">{{$item->display_name}}</option>
                            @endif
                          @endif
                      @endforeach
                    </select>
                  </div>
                </div>


                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="uusers.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_userRegister')">{{trans('resource.buttons.close')}}</button>
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

<header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 65, "stickySetTop": "-65px", "stickyChangeLogo": true}'>
  <div class="header-body">
    <div class="header-container container">
      <div class="header-row">
        <div class="header-column">
          <div class="header-logo">
            <a href="/">
              <img alt="Асгат" width="82" height="82" data-sticky-width="60" data-sticky-height="60" data-sticky-top="40" src="/img/asgat_logo.png">
            </a>
          </div>
        </div>
        <div class="header-column">
          <div class="header-row">
            <div class="header-search hidden-xs">
              <form id="searchForm" action="page-search-results.html" method="get">
                <div class="input-group">
                  <input type="text" class="form-control" name="q" id="q" placeholder="Хайлт..." required>
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </form>
            </div>
            <nav class="header-nav-top">
              <ul class="nav nav-pills">
                {{-- <li class="hidden-xs">
                  <a href=""><i class="fa fa-angle-right"></i> Бидний тухай</a>
                </li> --}}
                <li class="hidden-xs">
                  <a href="/complaints"><i class="fa fa-angle-right"></i> Санал хүсэлт</a>
                </li>
                {{-- <li class="hidden-xs">
                  <span class="ws-nowrap"><i class="fa fa-phone"></i> 99******</span>
                </li> --}}
                <li>
                  <a href="#" class="dropdown-menu-toggle" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img src="/img/blank.gif" class="flag flag-{{($cur_lang->lang_key == 'en') ? 'us' : $cur_lang->lang_key}}" alt="" /> {{$cur_lang->lang_name}}
                    <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLanguage">
                    @foreach($langs as $l)
                    <li><a href="" onclick="$.get('/changeLang/{{$l->lang_key}}', null, function(){ location.reload() })"><img src="/img/blank.gif" class="flag flag-{{($l->lang_key == 'en') ? 'us' : $l->lang_key}}" alt="" /> {{$l->lang_name}}</a></li>
                    @endforeach
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
          <div class="header-row">
            <div class="header-nav">
              <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                <i class="fa fa-bars"></i>
              </button>
              <ul class="header-social-icons social-icons hidden-xs">
                <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
              </ul>
              <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                <nav>
                  <ul class="nav nav-pills" id="mainNav">
                    @php
                      $allcat = clone $categories;
                      $tmp_allcat = clone $categories;
                    @endphp
                    @foreach($allcat->where('parent_id', 0)->get() as $category)
                      @php
                        $tmp = clone $tmp_allcat;

                        $url = '';
                        if($category->url == '#$cat$#'){
                          $url = '/category/'.$category->ca_id;
                        }else{
                          $url = $category->url;
                        }
                      @endphp
                      @if(count($tmp->where('parent_id', $category->ca_id)->get()) != 0)
                        <li class="dropdown"><a href="{{$url}}" target="{{$category->target}}" class="dropdown-toggle"> {{$category->source}} </a>
                      @else
                        <li class="dropdown"><a href="{{$url}}" target="{{$category->target}}"> {{$category->source}} </a>
                      @endif

                      {{getSource($category, clone $categories)}}
                      <li>
                    @endforeach
                      <li>
                        @if (!Auth::check())
                        <li class="dropdown dropdown-mega dropdown-mega-signin signin logged" id="">
                          <a class="dropdown-toggle" href="">
                            <i class="fa fa-user"></i> Нэвтрэх
                          </a>
                          <ul class="dropdown-menu">
                            <li>
                              <div class="dropdown-mega-content">
                                <div class="row">
                                  <div class="col-md-12">

                                    <div class="signin-form">

                                      <!-- <span class="dropdown-mega-sub-title">Нэвтрэх</span> -->

                                      <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                          <div class="form-group">
                                            <div class="col-md-12">
                                              <label>Хэрэглэгчийн нэр</label>
                                              <input id="email" type="email" class="form-control input-lg" tabindex="1" name="email" value="{{ old('email') }}" required>
                                              @if ($errors->has('email'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('email') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="form-group">
                                            <div class="col-md-12">
                                              <label>Нууц үг</label>
                                              <input id="password" type="password" class="form-control input-lg" tabindex="2" name="password" required>
                                              @if ($errors->has('password'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('password') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <span class="remember-box checkbox">
                                              <label for="rememberme">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Намайг сана
                                              </label>
                                            </span>
                                          </div>
                                          <div class="col-md-6">
                                            <input type="submit" value="Нэвтрэх" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
                                          </div>
                                        </div>
                                      </form>

                                    </div>

                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </li>
                        @else
                        <li class="dropdown dropdown-mega dropdown-mega-signin signin logged" id="headerAccount">
                          <a class="dropdown-toggle" href="#">
                            <i class="fa fa-user"></i> {{ucfirst(Auth::user()->name)}}
                          </a>
                          <ul class="dropdown-menu">
                            <li>
                              <div class="dropdown-mega-content">

                                <div class="row">
                                  <div class="col-md-8 col-sm-4 col-xs-5">
                                    <div class="user-avatar">
                                      <div class="img-thumbnail">
                                        <img src="/img/clients/client-1.jpg" alt="">
                                      </div>
                                      <span><strong>{{$client->name}}</strong> {{ucfirst(Auth::user()->name)}}</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-4 col-xs-2">
                                    <ul class="">
                                      <li>
                                        <button class="btn btn-borders btn-xs btn-warning" type="button" onclick="location.href='/sys/order'"><i class="fa fa-cloud"></i> Захиалга</button>
                                      </li>
                                      <li>
                                        <button class="btn btn-borders btn-xs btn-danger" type="button" onclick="$('#logout-form').submit()">Гарах</button>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                      </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </li>

                        @endif
                      </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @php
    function getSource($c, $tmp_allcats){
      $subcats = clone $tmp_allcats;
      $tmp_subcats = clone $tmp_allcats;
      $cats = $tmp_allcats->where('parent_id', $c->ca_id)->get();
      if(count($cats) != 0){
        echo '<ul class="dropdown-menu">';
        foreach($cats as $cat){

          $url = '';
          if($cat->url == '#$cat$#'){
            $url = '/category/'.$cat->ca_id;
          }else{
            $url = $cat->url;
          }

          if(count($subcats->where('parent_id', $cat->ca_id)->get()) != 0){
            echo '<li class="dropdown-submenu"><a href="'.$url.'" target="'.$cat->target.'">'.$cat->source.'</a>';
            getSource($cat, $tmp_subcats);
          }else{
            echo '<li><a href="'.$url.'" target="'.$cat->target.'">'.$cat->source.'</a>';
          }
          echo '</li>';
        }
        echo '</ul>';
      }

    }
  @endphp

</header>

<hr>

<!-- POLL START -->
@if(!empty($poll))
{{ csrf_field() }}
<blockquote class="blockquote-secondary">
  <h5 class="heading-primary">{{trans('resource.polling')}}</h5>
</blockquote>
<blockquote class="with-borders">
  <blockquote class="">
    <h6 class=""><strong>{{$poll->source}}</strong></h6>
  </blockquote>
  <div id="poll-list">
  @foreach($answers as $a)
    @if(Session::get('poll'))
      <div><label class="rd-label">{{$a->source}}</label>&nbsp;-&nbsp;<label class="rd-label pull-right">{{$a->total}}</label></div>
    @else
      <div class="radio"><label><input type="radio" name="answer" value="{{$a->id}}"> {{$a->source}}</label></div>
    @endif
  @endforeach
  </div>
  @if(!Session::get('poll'))
  <button class="btnPollSubmit btn btn-borders btn-default mr-xs mb-sm" type="button" onclick="submitpoll({{$poll->id}})">{{trans('resource.poll.givepoll')}}</button>
  @endif
</blockquote>
@endif

<div class="tabs mb-xlg">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#popularPosts" data-toggle="tab"><i class="fa fa-star"></i> Popular</a></li>
    <li><a href="#recentPosts" data-toggle="tab">Recent</a></li>
  </ul>
</div>
<!-- POLL END -->

</aside>

<script>
function submitpoll(poll_id){
  if($("[name=answer]").val() != undefined && $("[name=answer]").val() != null){
      $.post("/submitpoll", {'answer_id': $("[name=answer]").val(), 'poll_id' : poll_id, '_token' : $("[name='_token']").val()}, function(data){
          $obj = "";
          $.each(data, function(i, v){
              $obj += '<div><label class="rd-label">'+v.source+'</label>&nbsp;-&nbsp;<label class="rd-label pull-right" >'+v.total+'</label></div>';
          });
          $(".btnPollSubmit").remove();
          $("#poll-list").html($obj);
      });
  }
}
</script>

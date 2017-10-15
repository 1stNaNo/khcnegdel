<!DOCTYPE html>
<html class="fixed">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8" />
<title>{{ config('app.name', 'Unity WEB v1.0') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script type="text/javascript">

  //javascript action variables
  var sys = {};

  //javascript text resource variables
  var messages = {};
  messages.saved = '{!! trans('resource.saved') !!}';
  messages.removed = '{!! trans('resource.message.deleted') !!}';
  messages.fill = '{!! trans('resource.message.fill') !!}';

  var system = {}
  system.edit = '{!! trans('system.edit') !!}';
  system.delete = '{!! trans('system.delete') !!}';
  system.new = '{!! trans('system.new') !!}';

  var categoryres = {};
  categoryres.news = '{!! trans('resource.news.title') !!}';
  categoryres.self = '{{trans('resource.category.self')}}';
  categoryres.blank = '{{trans('resource.category.blank')}}';

  var mainres = {};
  mainres.active = '{!! trans('resource.main.active') !!}';
  mainres.deactive = '{{trans('resource.main.deactive')}}';
  mainres.confirm = '{{trans('resource.confirm')}}';
  mainres.notification = '{{trans('resource.main.notification')}}';

  var weblinkres = {};
  weblinkres.sums = '{!! trans('resource.weblinks.sums') !!}';
  weblinkres.agency = '{{trans('resource.weblinks.agency')}}';
  weblinkres.others = '{{trans('resource.weblinks.others')}}';

  var decisions = {};
  decisions.kindposi = '{!! trans('resource.decision.positive') !!}';
  decisions.kindnega = '{!! trans('resource.decision.negative') !!}';
  decisions.done = '{!! trans('resource.decision.done') !!}';
  decisions.undone = '{!! trans('resource.decision.undone') !!}';

  var polls = {};
  polls.active = '{!! trans('resource.poll.active') !!}';
  polls.inactive = '{!! trans('resource.poll.inactive') !!}';
  polls.makeactive = '{!! trans('resource.poll.makeactive') !!}';
  polls.makeinactive = '{!! trans('resource.poll.makeinactive') !!}';

  var shorters = {};
  shorters.self = '{!! trans('resource.category.self') !!}';
  shorters.blank = '{!! trans('resource.category.blank') !!}';
</script>

{{-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"> --}}

<!-- Vendor CSS -->
<link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />

<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="/assets/vendor/morris/morris.css" />

    <link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    <link rel="stylesheet" href="/assets/summernote/summernote.css" >
    <link rel="stylesheet" href="/assets/vendor/pnotify/pnotify.custom.css" />

		<link rel="stylesheet" href="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />

<!-- Theme CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme.css" />
<link rel="stylesheet" href="/css/style.css" />

<!-- Skin CSS -->
<link rel="stylesheet" href="/assets/stylesheets/skins/default.css" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme-custom.css">

<!-- Head Libs -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsKm206dcDV4uKE2N6KZpIVVzjysppNXQ"></script>
<script src="/assets/ckeditor/ckeditor.js"></script>
<script src="/assets/vendor/jquery/jquery.js"></script>
<script src="/assets/ckeditor/adapters/jquery.js"></script>
<script src="/assets/vendor/modernizr/modernizr.js"></script>
</head>
<body>
<section class="body">

  <!-- start: header -->
  <header class="header">
    <div class="logo-container">
      <a href="../" class="logo">
        <img src="/assets/images/logo.png" height="35" alt="Porto Admin" />
      </a>
      <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
      </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

      {{-- <form action="pages-search-results.html" class="search nav-form">
        <div class="input-group input-search">
          <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form> --}}

      {{-- <span class="separator"></span> --}}

      {{-- <ul class="notifications">
        <li>
          <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
            <i class="fa fa-tasks"></i>
            <span class="badge">3</span>
          </a>

          <div class="dropdown-menu notification-menu large">
            <div class="notification-title">
              <span class="pull-right label label-default">3</span>
              Tasks
            </div>

            <div class="content">
              <ul>
                <li>
                  <p class="clearfix mb-xs">
                    <span class="message pull-left">Generating Sales Report</span>
                    <span class="message pull-right text-dark">60%</span>
                  </p>
                  <div class="progress progress-xs light">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                  </div>
                </li>

                <li>
                  <p class="clearfix mb-xs">
                    <span class="message pull-left">Importing Contacts</span>
                    <span class="message pull-right text-dark">98%</span>
                  </p>
                  <div class="progress progress-xs light">
                    <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                  </div>
                </li>

                <li>
                  <p class="clearfix mb-xs">
                    <span class="message pull-left">Uploading something big</span>
                    <span class="message pull-right text-dark">33%</span>
                  </p>
                  <div class="progress progress-xs light mb-xs">
                    <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
            <i class="fa fa-envelope"></i>
            <span class="badge">4</span>
          </a>

          <div class="dropdown-menu notification-menu">
            <div class="notification-title">
              <span class="pull-right label label-default">230</span>
              Messages
            </div>

            <div class="content">
              <ul>
                <li>
                  <a href="#" class="clearfix">
                    <figure class="image">
                      <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
                    </figure>
                    <span class="title">Joseph Doe</span>
                    <span class="message">Lorem ipsum dolor sit.</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="clearfix">
                    <figure class="image">
                      <img src="/assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                    </figure>
                    <span class="title">Joseph Junior</span>
                    <span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="clearfix">
                    <figure class="image">
                      <img src="/assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
                    </figure>
                    <span class="title">Joe Junior</span>
                    <span class="message">Lorem ipsum dolor sit.</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="clearfix">
                    <figure class="image">
                      <img src="/assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                    </figure>
                    <span class="title">Joseph Junior</span>
                    <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
                  </a>
                </li>
              </ul>

              <hr />

              <div class="text-right">
                <a href="#" class="view-more">View All</a>
              </div>
            </div>
          </div>
        </li>
        <li>
          <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="badge">3</span>
          </a>

          <div class="dropdown-menu notification-menu">
            <div class="notification-title">
              <span class="pull-right label label-default">3</span>
              Alerts
            </div>

            <div class="content">
              <ul>
                <li>
                  <a href="#" class="clearfix">
                    <div class="image">
                      <i class="fa fa-thumbs-down bg-danger"></i>
                    </div>
                    <span class="title">Server is Down!</span>
                    <span class="message">Just now</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="clearfix">
                    <div class="image">
                      <i class="fa fa-lock bg-warning"></i>
                    </div>
                    <span class="title">User Locked</span>
                    <span class="message">15 minutes ago</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="clearfix">
                    <div class="image">
                      <i class="fa fa-signal bg-success"></i>
                    </div>
                    <span class="title">Connection Restaured</span>
                    <span class="message">10/10/2014</span>
                  </a>
                </li>
              </ul>

              <hr />

              <div class="text-right">
                <a href="#" class="view-more">View All</a>
              </div>
            </div>
          </div>
        </li>
      </ul> --}}

      <span class="separator"></span>

      <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
          <figure class="profile-picture">
            <img src="/assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="/assets/images/!logged-user.jpg" />
          </figure>
          <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
            <span class="name">{{ Auth::user()->name }}</span>
            <span class="role">administrator</span>
          </div>

          <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
          <ul class="list-unstyled">
            <li class="divider"></li>
            {{-- <li>
              <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
            </li> --}}
            {{-- <li>
              <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
            </li> --}}
            <li>
              <a role="menuitem" tabindex="-1" href="/admin/password"><i class="fa fa-lock"></i> {{trans('resource.password')}}</a>
            </li>
            <li>
              <a role="menuitem" tabindex="-1" onclick="$('#logout-form').submit()" href="#"><i class="fa fa-power-off"></i> {{trans('resource.main.exit')}}</a>
            </li>
          </ul>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
    <!-- end: search & user box -->
  </header>
  <!-- end: header -->

  <div class="inner-wrapper">
    <!-- start: sidebar -->
    <aside id="sidebar-left" class="sidebar-left">

      <div class="sidebar-header">
        <div class="sidebar-title">
          {{trans('resource.category.title')}}
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
          <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
      </div>

      <div class="nano">
        <div class="nano-content">
          <nav id="menu" class="nav-main" role="navigation">
            <ul class="nav nav-main">
              @if(Auth::user()->can('dashboard'))
                <li class="nav-active">
                  <a href="/home">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>{{trans('resource.main.controlSection')}}</span>
                  </a>
                </li>
              @endif
              <li class="nav-parent">
                <a>
                  <i class="fa fa-cloud" aria-hidden="true"></i>
                  <span>{{trans('resource.sys.order')}}</span>
                </a>
                <ul class="nav nav-children">
                  <li>
                    <a href="/sys/order">
                       {{trans('resource.sys.order')}}
                    </a>
                  </li>
                  @if(Auth::user()->can('orderUser'))
                    <li>
                      <a href="/sys/clients">
                         {{trans('resource.sys.clients')}}
                      </a>
                    </li>
                  @endif
                  @if(Auth::user()->can('orderTime'))
                    <li>
                      <a href="/sys/interval">
                         {{trans('resource.sys.interval')}}
                      </a>
                    </li>
                  @endif
                  @if(Auth::user()->can('orderUnit'))
                    <li>
                      <a href="/sys/masters">
                         {{ trans('resource.sys.unit') }}
                      </a>
                    </li>
                  @endif
                  @if(Auth::user()->can('orderProduct'))
                    <li>
                      <a href="/sys/product">
                         {{ trans('resource.sys.product') }}
                      </a>
                    </li>
                  @endif
                  @if(Auth::user()->can('orderProduct'))
                    <li>
                      <a href="/sys/product/type">
                         {{ trans('resource.sys.producttype') }}
                      </a>
                    </li>
                  @endif
                </ul>
              </li>
              {{-- @if(Auth::user()->can('category'))
                <li class="">
                  <a href="/admin/category">
                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                    <span>{{trans('resource.category.title')}}</span>
                  </a>
                </li>
              @endif --}}

              @if(Auth::user()->can('address'))
                <li class="">
                  <a href="/sys/address">
                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                    <span>{{trans('Хаяг')}}</span>
                  </a>
                </li>
              @endif

              @if(Auth::user()->can('news'))
              <li class="nav-parent">
                <a>
                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                  <span>{{trans('resource.news.title')}}</span>
                </a>
                <ul class="nav nav-children">
                  <li>
                    <a href="/admin/news">
                       {{trans('resource.news.title')}}
                    </a>
                  </li>
                  <li>
                    <a href="/admin/shorter">
                       {{trans('resource.main.shorter')}}
                    </a>
                  </li>
                  {{-- <li>
                    <a href="/admin/external">
                       {{trans('resource.main.external')}}
                    </a>
                  </li> --}}
                </ul>
              </li>
              @endif

              @if(Auth::user()->can('link'))
                <li class="">
                  <a href="/admin/weblink">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span>{{trans('resource.weblinks.link')}}</span>
                  </a>
                </li>
              @endif

              @if(Auth::user()->can('complaints'))
              <li class="">
                <a href="/admin/decision">
                  <i class="fa fa-file-text-o" aria-hidden="true"></i>
                  <span>{{trans('resource.decision.menu')}}</span>
                </a>
              </li>
              @endif

              @if(Auth::user()->can('poll'))
                <li class="">
                  <a href="/admin/poll">
                    <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    <span>{{trans('resource.polling')}}</span>
                  </a>
                </li>
              @endif

              {{-- <li class="">
                <a href="/admin/banner">
                  <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                  <span>{{trans('resource.banner.banner')}}</span>
                </a>
              </li> --}}

              @if(Auth::user()->can('mainConf'))
                <li class="nav-parent">
                  <a>
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    <span>{{trans('resource.main.conf')}}</span>
                  </a>
                  <ul class="nav nav-children">
                    <li>
                      <a href="/admin/title">
                         {{trans('resource.webtitle')}}
                      </a>
                    </li>
                    <li>
                      <a href="/admin/newscat">
                         {{trans('resource.main.home')}}
                      </a>
                    </li>
                    <li>
                      <a href="/admin/links">
                         {{trans('resource.weblinks.link')}}
                      </a>
                    </li>
                    <li>
                      <a href="/admin/contact">
                         {{trans('resource.contact')}}
                      </a>
                    </li>
                  </ul>
                </li>
              @endif

              @if(Auth::user()->can('users'))
                <li class="nav-parent">
                  <a>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>{{trans('resource.users')}}</span>
                  </a>
                  <ul class="nav nav-children">
                    <li>
                      <a href="/admin/users">
                         {{trans('resource.users')}}
                      </a>
                    </li>
                    <li>
                      <a href="/admin/role">
                         {{trans('resource.role.title')}}
                      </a>
                    </li>
                  </ul>
                </li>
              @endif

              @if(Auth::user()->can('fileManager'))
                <li>
                  <a href="#" onclick="openRequestedPopup(route_prefix + '?type=Images&langCode=mn')">
                    <i class="fa fa-photo" aria-hidden="true"></i>
                    <span>{{trans('resource.weblinks.img')}}</span>
                  </a>
                </li>
              @endif

              {{-- <li class="nav-parent">
                <a>
                  <i class="fa fa-columns" aria-hidden="true"></i>
                  <span>{{trans('resource.file.files')}}</span>
                </a>
                <ul class="nav nav-children">
                  <li>
                    <a href="/admin/filetype">
                       {{trans('resource.file.type')}}
                    </a>
                  </li>
                  <li>
                    <a href="/admin/file">
                       {{trans('resource.file.file')}}
                    </a>
                  </li>
                  <li>
                    <a href="#" onclick="openRequestedPopup('/admin/icons')">
                       {{trans('resource.main.icon')}}
                    </a>
                  </li>
                </ul>
              </li> --}}
            </ul>
          </nav>

        </div>

      </div>

    </aside>
    <!-- end: sidebar -->

    <section role="main" class="content-body">
      <header class="page-header">
        <h2>{{trans('resource.main.controlSection')}}</h2>

        <div class="right-wrapper pull-right">
          {{-- <ol class="breadcrumbs">
            <li>
              <a href="/home">
                <i class="fa fa-home"></i>
              </a>
            </li>
            <li><span>Dashboard</span></li>
          </ol> --}}

          <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
      </header>

      <!-- start: page -->
      <div class="uMainContent">
        @yield('content')
      </div>
      <!-- end: page -->
    </section>
  </div>

  <aside id="sidebar-right" class="sidebar-right">
    <div class="nano">
      <div class="nano-content">
        <a href="#" class="mobile-close visible-xs">
          Collapse <i class="fa fa-chevron-right"></i>
        </a>

        <div class="sidebar-right-wrapper">

          <div class="sidebar-widget widget-calendar">
            <h6>Upcoming Tasks</h6>
            <div id="mainCalendar" data-plugin-datepicker data-plugin-skin="dark" defaultViewDate="today"></div>

            {{-- <ul>
              <li>
                <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                <span>Company Meeting</span>
              </li>
            </ul> --}}
          </div>

          <div class="sidebar-widget widget-friends">
            {{-- <h6>Friends</h6>
            <ul>
              <li class="status-online">
                <figure class="profile-picture">
                  <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                </figure>
                <div class="profile-info">
                  <span class="name">Joseph Doe Junior</span>
                  <span class="title">Hey, how are you?</span>
                </div>
              </li>
              <li class="status-online">
                <figure class="profile-picture">
                  <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                </figure>
                <div class="profile-info">
                  <span class="name">Joseph Doe Junior</span>
                  <span class="title">Hey, how are you?</span>
                </div>
              </li>
              <li class="status-offline">
                <figure class="profile-picture">
                  <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                </figure>
                <div class="profile-info">
                  <span class="name">Joseph Doe Junior</span>
                  <span class="title">Hey, how are you?</span>
                </div>
              </li>
              <li class="status-offline">
                <figure class="profile-picture">
                  <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                </figure>
                <div class="profile-info">
                  <span class="name">Joseph Doe Junior</span>
                  <span class="title">Hey, how are you?</span>
                </div>
              </li>
            </ul> --}}
          </div>

        </div>
      </div>
    </div>
  </aside>
</section>

<!-- Vendor -->

		<script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Specific Page Vendor -->
		<script src="/assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="/assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="/assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="/assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="/assets/vendor/flot/jquery.flot.js"></script>
		<script src="/assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="/assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="/assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="/assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="/assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="/assets/vendor/raphael/raphael.js"></script>
		<script src="/assets/vendor/morris/morris.js"></script>
		<script src="/assets/vendor/gauge/gauge.js"></script>
		<script src="/assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="/assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="/assets/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="/assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
    <script src="/assets/vendor/fuelux/js/spinner.js"></script>
    <script src="/assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>

    <!-- Specific Page Vendor -->
		<script src="/assets/vendor/select2/select2.js"></script>
		<script src="/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="/assets/summernote/summernote.js" type="text/javascript"></script>
    <script src="/assets/js/sticky-kit.js" type="text/javascript"></script>
    <script src="/assets/vendor/pnotify/pnotify.custom.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.serialize-object.js" type="text/javascript"></script>
    <script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="/assets/vendor/ios7-switch/ios7-switch.js"></script>
    <script type="text/javascript">
      var route_prefix = "{{ url(config('lfm.prefix')) }}";
      {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
    </script>




    <!-- DATATABLES -->
    {{-- <script src="/assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/assets/jquery-datatable/extra/js/TableTools.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/datatables-responsive/js/datatables.responsive.js"></script> --}}
    <script src="/assets/vendor/jstree/jstree.js"></script>
    <script src="/js/examples.treeview.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="/assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="/assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>


<!-- Examples -->
{{-- <script src="/assets/javascripts/dashboard/examples.dashboard.js"></script> --}}
<script src="/assets/js/main.js"></script>
</body>
</html>

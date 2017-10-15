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
  var messages = {};
  messages.saved = '{!! trans('resource.saved') !!}';
  messages.removed = '{!! trans('resource.message.deleted') !!}';
  messages.fill = '{!! trans('resource.message.fill') !!}';

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

<!-- Theme CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme.css" />

<!-- Skin CSS -->
<link rel="stylesheet" href="/assets/stylesheets/skins/default.css" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="/assets/stylesheets/theme-custom.css">

<!-- Head Libs -->
<script src="/assets/vendor/jquery/jquery.js"></script>
<script src="/assets/vendor/modernizr/modernizr.js"></script>
</head>
<body>
<section class="body">

    <div class="uMainContent">
      @yield('content')
    </div>

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

    <!-- Specific Page Vendor -->
		<script src="/assets/vendor/select2/select2.js"></script>
		<script src="/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="/assets/summernote/summernote.js" type="text/javascript"></script>
    <script src="/assets/js/sticky-kit.js" type="text/javascript"></script>
    <script src="/assets/vendor/pnotify/pnotify.custom.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.serialize-object.js" type="text/javascript"></script>



    <!-- DATATABLES -->
    {{-- <script src="/assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/assets/jquery-datatable/extra/js/TableTools.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/datatables-responsive/js/datatables.responsive.js"></script> --}}

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

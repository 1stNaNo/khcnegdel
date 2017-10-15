<!DOCTYPE html>
<html>
	@include('layouts.submain.header')
	<body>
		<div class="body">
      @include('layouts.web.main_temp_top')
			@include('layouts.web.slide_main')
			<div class="col-md-1"></div>
			<div class="col-md-8">
				@yield('content')
			</div>
			<div class="col-md-3">
				@include('layouts.submain.sidebar')
			</div>
			<div class="col-md-12" style="padding: 0;">
				@yield('contentFull')
			</div>
		</div>
    @include('layouts.submain.foot')

	</body>
</html>

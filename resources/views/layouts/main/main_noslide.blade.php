<!DOCTYPE html>
<html>
	@include('layouts.submain.header')
	<body>
		<div class="body">
      @include('layouts.web.main_temp_top')
			<div class="col-md-1"></div>
			<div class="col-md-8">
				@yield('content')
			</div>
			<div class="col-md-3">
				@include('layouts.submain.sidebar')
			</div>
		</div>
    @include('layouts.submain.foot')

	</body>
</html>

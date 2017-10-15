<div id="window_roleIndex">
	<input type="hidden" class="prev_window"/>
	<div class="row">
			<div class="col-lg-12">
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
								<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
							</div>

							<h2 class="panel-title">{{ trans('resource.main.shorter') }}</h2>
						</header>
						<div class="panel-body">
							<form action="" id="roleupdate_form" class="form-horizontal form-bordered">
								<input name="id" value="{{$role->id}}" placeholder="" class="form-control input-md" type="hidden">

								<div class="form-group">
									<label class="col-md-3 control-label" for="">Түлхүүр үг:</label>
									<div class="col-md-6">
										<input name="name" value="{{$role->name}}" placeholder="" class="form-control input-md" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="">Дэлгэцийн нэр:</label>
									<div class="col-md-6">
										<input name="display_name" value="{{$role->display_name}}" placeholder="" class="form-control input-md" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="">Тайлбар:</label>
									<div class="col-md-6">
										<input name="description" value="{{$role->description}}" placeholder="" class="form-control input-md" type="text">
									</div>
								</div>

								<div class="form-group" style="margin-bottom: 0;">
									<label class="col-md-3 control-label" for="">Эрх:</label>
										<div class="col-md-6">
										</div>
								</div>

								@foreach($permission as $item)
									<div class="form-group" style="margin-bottom: 0;">
											<label class="col-md-3 control-label" for=""></label>
											<div class="col-md-1">
												@if(!empty($rp["key".$item->id]))
													<div class="switch switch-sm switch-success">
														<input checked="checked" data-plugin-ios-switch name="permission[{{$item->id}}]" value="{{$item->id}}" placeholder="" class="form-control input-md" type="checkbox" style="float: left; width: 6%;">
													</div>
												@else
													<div class="switch switch-sm switch-success">
														<input data-plugin-ios-switch name="permission[{{$item->id}}]" value="{{$item->id}}" placeholder="" class="form-control input-md" type="checkbox" style="float: left; width: 6%;">
													</div>
												@endif
											</div>
											<label class="col-md-5 control-label" style="text-align: left;" for="">{{$item->display_name}} / {{$item->description}}</label>
									</div>
								@endforeach

								<div class="form-group usticky" style="background: #fff;">
									<div class="col-md-12">
										<div style="float: right;">
											<button type="button" class="btn btn-primary" onclick="urole.save(); return false;">{{trans('resource.buttons.save')}}</button>
											<button type="button" class="btn" onclick="uPage.close('window_roleIndex');return false;">{{trans('resource.buttons.close')}}</button>
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
				$("input[type='checkbox']").themePluginIOS7Switch();
			});
	</script>
</div>

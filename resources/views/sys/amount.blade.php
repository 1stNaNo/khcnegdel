<form action="/sys/order/save" id="orderregister_form" class="form-horizontal form-bordered">
	<input type="hidden" value="{{$split}}" name="split" />
	<input type="hidden" value="{{$order_id}}" name="order_id" />
	<input type="hidden" value="{{$product_id}}" name="product_id" />
	@if($split == 0)
	<div class="row">
		<div class="col-md-3">
			<input type="text" value="" class="form-control" name="size" placeholder="Тоо хэмжээ">
		</div>
		<div class="col-md-3">
			<select id="unit_id" name="unit_id" class="form-control" style="width:100%">;
				@foreach($measures as $m)
					<option value="{{$m->master_id}}">{{$m->unit_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-primary" onclick="saveorder()">{{trans('resource.buttons.save')}}</button>
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-danger" onclick="$('#myModal').modal('hide')">Болих</button>
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-2">
			Даваа : 
			<input type="text" value="" name="day[0]" class="form-control day">
		</div>
		<div class="col-md-2">
			Мягмар : 
			<input type="text" value="" name="day[1]" class="form-control day">
		</div>
		<div class="col-md-2">
			Лхагва :
			<input type="text" value="" name="day[2]" class="form-control day">
		</div>
		<div class="col-md-2">
			Пүрэв : 
			<input type="text" value="" name="day[3]" class="form-control day">
		</div>
		<div class="col-md-2">
			Баасан :
			<input type="text" value="" name="day[4]" class="form-control day">
		</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-2">
			Нэгж : 
			<select id="unit_id" name="unit_id" class="form-control" style="width:100%">;
				@foreach($measures as $m)
					<option value="{{$m->master_id}}">{{$m->unit_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2">
			&nbsp;
			<button type="button" class="btn btn-primary" onclick="saveorder()">{{trans('resource.buttons.save')}}</button>
		</div>
		<div class="col-md-2">
			&nbsp;
			<button type="button" class="btn btn-danger" onclick="$('#myModal').modal('hide')">Болих</button>
		</div>
	</div>

	@endif
</form>
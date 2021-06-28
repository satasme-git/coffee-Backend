<div class="size-item clearfix">
	<div class="col-sm-4 col-xs-12">
		<div class="form-group">
			<div>
				<input type="text"  name="size[{{$k}}]" class="form-control required" placeholder="size" value="{{$size}}">
			</div>
		</div>
	</div>
	<div class="col-sm-3 col-xs-12">
		
			<div class="input-group">
				<span class="input-group-addon">{{env('CURRENCY_SYMBOL')}}</span>
				<input type="number"  name="price[{{$k}}]" class="form-control required" step="0.01" min="0.01" value="{{$price}}">
				
			</div>
		
	</div>
	<div class="col-sm-2 col-xs-6">
			<div>
				<input type="number"  name="width[{{$k}}]" class="form-control required" placeholder="width in mm" step="1" min="1" value="{{$width}}">
			</div>
		
	</div>
	<div class="col-sm-2 col-xs-6">
			<div>
				<input type="number"  name="height[{{$k}}]" class="form-control required" placeholder="height in mm" step="1" min="1" value="{{$height}}">
			</div>
		
	</div>
	<div class="col-sm-1 col-xs-3 text-right">
		<div class="form-group">
		<button id="addmore" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
		</div>
	</div>
		
	
</div>
@extends('admin.layouts.home')
@section('content')
<link href="{{url('/')}}/css/plugins/dataTables/datatables.css">

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title clearfix">
					<h5 >Size</h5>
					
					
				</div>
				
				<div class="ibox-content">				
					
					<div class="row">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="{{url('/admin/slides')}}">
								{{ csrf_field() }}
								<div class="col-md-6">
								<div class="form-group clearfix">
									<label>Image Preview</label>
									<div class="{{ $errors->has('thumb') ? ' has-error' : '' }}">
										<div class="input-group">
											<label class="input-group-btn">
												<span class="btn btn-primary" onclick="$('#thumbimage').trigger('click');">
													Browse 
												</span>
												
											</label>
											<input id="thumbinput" type="text" class="form-control" readonly="" value="@if(isset($data->thumb)) {{$data->thumb}} @endif ">
											
											<input type="file"  autocomplete="off" name="thumb" accept="image/*" id="thumbimage" class="form-control"  style="display:none" />
											
										</div>
										@if ($errors->has('thumb'))
										<span class="help-block m-b-none">
											<strong>{{ $errors->first('thumb') }}</strong>
										</span>
										@endif
										
									</div>
								</div>
								<div class="form-group">
								<label >Description</label>
                                        <input type="text"  autocomplete="off" name="description" id="description"  class="form-control"/>
								</div>
								@if(!empty($slides->id))
									<input type="hidden" name="id" value="{{$slides->id}}">
								@endif
								<div class="form-group">
									<button class="btn btn-primary ">Save</button>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{url('/')}}/js/plugins/dataTables/datatables.min.js"></script>
<script src="{{url('/')}}/js/plugins/bootbox/bootbox.min.js"></script>
<script>
	$(document).ready(function(){
		$('.dataTables-example').DataTable({
			order:[]
			
		});

		$("#thumbimage").on("change", function(){			
		var files = !!this.files ? this.files : [];			
		if ( !files.length || !window.FileReader ) return;		
		$('#thumbinput').val(this.files.length ? this.files[0].name : '');			
		
		});
		
		$(".number").on("keypress keyup blur",function (event) {
			//this.value = this.value.replace(/[^0-9\.]/g,'');
			$(this).val($(this).val().replace(/[^0-9\.]/g,''));
			if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});
		
		$('#service').change(function(){
			var service = $(this).val();
				$.ajax({
					url: "{{url('/admin/otheroption')}}",
					method : "POST",
					data : {						
						service:service,
					},
					headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
					context: document.body,					
				}).done(function(response) {					
					$('#other').html(response);				
					
				});
				
		})
		
	});
	
</script>
@endsection 
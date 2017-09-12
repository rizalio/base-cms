		<section class="section contact">
			<div class="container">
				<h2 class="section-title">{{section('section_contact', 'title')}}</h2>

				<div class="section-body">
					<div class="row">
						@foreach(section('contact_us') as $contact)
						<div class="col-md-4 col-sm-4">
							<div class="contact-item">
								<div class="icon">
									<i class="{{$contact->icon}}"></i>
								</div>
								<div class="contact-title">
									{{$contact->title}}
								</div>
								<div class="contact-value">
									{!! $contact->description !!}
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="row">
						<form id="contact-form">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<input type="text" name="name" class="form-control" placeholder="{{__('master.Name')}}" required="">
								</div>
								<div class="form-group">
									<input type="email" name="email" class="form-control" placeholder="{{__('master.Email')}}" required="">
								</div>
								<div class="form-group">
									<input type="text" name="subject" class="form-control" placeholder="{{__('master.Subject')}}" required="">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<textarea name="message" class="form-control" placeholder="{{__('master.Enter Your Message')}}" required=""></textarea>
							</div>
							<div class="col-md-12 col-sm-12">
								<button class="btn btn-outline">
									{{__('master.Send')}}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

@section('js')
<script>
	$("#contact-form").submit(function(){
		var $this = $(this);
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$.ajax({
			url: base_url + '/contacts',
			data: {
				name: $this.find("[name=name]").val(),
				email: $this.find("[name=email]").val(),
				subject: $this.find("[name=subject]").val(),
				message: $this.find("[name=message]").val(),
				ajax: true
			},
			type: 'post',
			datatype: 'html',
			beforeSend: function() {
				$this.find("button").html("{{__('master.Please wait')}} ...");
			},
			complete: function() {
				console.log('complete')
				$this.find("button").html("{{__('master.Send')}}");
			},
			error: function(xhr) {
				swal("Ooppss!", "{{__('master.There was an error sending the message, check your internet connection and refresh this page')}}.", "error");
			},
			success: function(data) {
				data = jQuery.parseJSON(data);
				if(data.success == true) {
					swal("{{__('master.Success')}}", "{{__('master.Thank you for sending the message, your message we have successfully received')}}.", "success");
					$('#contact-form')[0].reset();
				}
			}
		})
		return false;
	});
</script>
@endsection
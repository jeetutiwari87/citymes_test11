@extends('front.login_template')

@section('main')
<div class="row">
<div class="col-sm-12">
@if(session()->has('status'))
	@include('partials/error', ['type' => 'success', 'message' => session('status')])
@endif
@if(session()->has('error'))
	@include('partials/error', ['type' => 'danger', 'message' => session('error')])
@endif
<h2>{{ trans('front/password.title') }}</h2>
<p>{{ trans('front/password.info') }}</p>
</div>

<div class="col-sm-6 col-sm-offset-3">
<div class="sigup content">
<div class="register">
<img class="register_logo"  src="{{asset("img/login_logo.png")}}"  />
<h3>{{ trans('front/password.title') }}</h3>
<p>{{ trans('front/password.reset-info') }}</p>
</div>
{!! Form::open(['url' => 'password/email', 'method' => 'post', 'role' => 'form']) !!}	
<ul>
<li>{!! Form::control1('email', 6, 'email', $errors, trans('front/password.email')) !!}</li>
<li>{!! Form::submit(trans('front/password.send')) !!}</li>
<li>
{!! link_to('/', trans('front/register.already_text')) !!}
</li>
</ul>
{!! Form::close() !!}
</div>
</div>
</div>
</div>

	<?php /*?><div class="row">
		<div class="box">
			<div class="col-lg-12">
				@if(session()->has('status'))
      				@include('partials/error', ['type' => 'success', 'message' => session('status')])
				@endif
				@if(session()->has('error'))
					@include('partials/error', ['type' => 'danger', 'message' => session('error')])
				@endif	
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/password.title') }}</h2>
				<hr>
				<p>{{ trans('front/password.info') }}</p>		
				{!! Form::open(['url' => 'password/email', 'method' => 'post', 'role' => 'form']) !!}	

					<div class="row">

						{!! Form::control('email', 6, 'email', $errors, trans('front/password.email')) !!}
						{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}
						{!! Form::text('address', '', ['class' => 'hpet']) !!}	
						
					</div>

				{!! Form::close() !!}

			</div>
		</div>
	</div><?php */?>
@stop
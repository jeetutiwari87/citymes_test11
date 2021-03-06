@extends('front.login_template')

@section('main')
<div class="row">
<div class="col-sm-12">
<h2>{{ trans('front/login.login_text') }}</h2>
<p>{{trans('front/login.login_desc')}}</p>
@if(session()->has('error'))
	@include('partials/error', ['type' => 'danger', 'message' => session('error')])
@endif	
				
</div>
<div class="col-sm-6 col-sm-offset-3">
<div class="login content">
<div class="register">
<img class="register_logo"  src="{{asset("img/login_logo.png")}}"  />
<h3>{{ trans('front/login.connection') }}</h3>
<p>{{ trans('front/login.text') }}</p>
</div>
{!! Form::open(['url' => '/', 'method' => 'post', 'role' => 'form']) !!}	
<ul>
<li>
{!! Form::control1('text', 6, 'log', $errors, trans('front/login.log')) !!}
</li>
<li>{!! Form::control1('password', 6, 'password', $errors, trans('front/login.password')) !!}</li>
<li>{!! Form::submit(trans('front/login.send')) !!}</li>
<li>
{!! link_to('auth/register', trans('front/login.registering'), ['class' => 'not_registred']) !!}

{!! link_to('password/email', trans('front/login.forget'), ['class' => 'forget_password']) !!}

</li>
</ul>
{!! Form::close() !!}

</div></div>

</div>



	<?php /*?><div class="row">
		<div class="box">
			<div class="col-lg-12">
				@if(session()->has('error'))
					@include('partials/error', ['type' => 'danger', 'message' => session('error')])
				@endif	
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/login.connection') }}</h2>
				<hr>
				<p>{{ trans('front/login.text') }}</p>				
				
				{!! Form::open(['url' => '/', 'method' => 'post', 'role' => 'form']) !!}	
				
				<div class="row">

					{!! Form::control('text', 6, 'log', $errors, trans('front/login.log')) !!}
					{!! Form::control('password', 6, 'password', $errors, trans('front/login.password')) !!}
					{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}
					{!! Form::check('memory', trans('front/login.remind')) !!}
					{!! Form::text('address', '', ['class' => 'hpet']) !!}		  
					<div class="col-lg-12">					
						{!! link_to('password/email', trans('front/login.forget')) !!}
					</div>

				</div>
				
				{!! Form::close() !!}

				<div class="text-center">
					<hr>
						<h2 class="intro-text text-center">{{ trans('front/login.register') }}</h2>
					<hr>	
					<p>{{ trans('front/login.register-info') }}</p>
					{!! link_to('auth/register', trans('front/login.registering'), ['class' => 'btn btn-default']) !!}
				</div>

			</div>
		</div>
	</div><?php */?>
@stop


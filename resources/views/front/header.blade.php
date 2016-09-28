<div class="col-sm-1 col-lg-1">
	<div class="user">
		<a href="{!! URL::to('/front_user') !!}">{!! HTML::image('img/front/img1.png') !!}</a>
		<!--{!! link_to_route_img('front_user.edit', HTML::image('img/front/img1.png'), [Auth::user()->id], ['class' => '']) !!}-->
	</div>
	
	<div class="col_content">
		<a href="#">{!! HTML::image('img/front/img2.png') !!}</a>
	</div>
	
	<div class="col_message">
		<a href="#">{!! HTML::image('img/front/message.png') !!}</a>
	</div>
	
	<div class="col_message">
		<a href="{!! URL::to('/language/en') !!}">{!! HTML::image('img/uk-big.png') !!}</a>
	</div>
	
	<div class="col_message">
		<a href="{!! URL::to('/language/fr') !!}">{!! HTML::image('img/france.png') !!}</a>
	</div>
	
	<div class="col_lock">
		<a href="{!! URL::to('/auth/logout') !!}">{!! HTML::image('img/front/img3.png') !!}</a>
	</div>
</div>
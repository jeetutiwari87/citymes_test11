@if($totalBots > 0)
	@foreach ($bots as $bot)
		<tr>
			<td>{{ $bot->stripe_customer_id }}</td>
			<td>{{ $bot->bot_token }}</td>
			<td>
				@if(!empty($bot->bot_image))
					{!! HTML::image('uploads/'.$bot->bot_image,'',array('class' => 'thumb')) !!}
				@endif
			</td>
			<td>{{ $bot->bot_description }}</td>
			<td>{{ $bot->start_message }}</td>
			<td>{{ $bot->autoresponse }}</td>
			<td>{{ $bot->contact_form }}</td>
			<td>{{ $bot->galleries }}</td>
			<td>{{ $bot->channels }}</td>
			<td>{{ $bot->created_at }}</td>
		</tr>
	@endforeach
@else
	<tr>
		<td colspan="11" class="no_record">{!! trans('back/bot.no_record') !!}</td>
	</tr>
@endif
@extends('front.template')
@section('main')

<!-- http://jlinn.github.io/stripe-api-php/api/subscriptions.html -->


<div class="col-sm-3 col-sm-offset-1  col-lg-2 col-lg-offset-1 ">
    <h1 class="logo">
        <a href="{!! URL::to('/dashboard') !!}">
            {!! HTML::image('img/front/logo.png') !!}
        </a>
    </h1>

    <h3>{{ trans('front/fornt_user.summary') }}</h3>
    <ul>
        <li>
            <p>
                <span>2</span>{{ trans('front/fornt_user.bots') }}
            </p>
        </li>

        <li>
            <p><span>3</span>{{ trans('front/fornt_user.channels') }}</p>
        </li>
    </ul>

    <div class="new_bot_channel">
        <a class="bot_button" href="{!! URL::to('/my_channel/create') !!}">{!! HTML::image('img/front/plus.png') !!}</a>
        <p>{{ trans('front/fornt_user.add_new_bot_chanel') }}</p>
    </div>
</div>

<div class="col-sm-8 col-sm-offset-4 col-lg-9 col-lg-offset-3">

    @include('front.top')

    <div class="my_account">
        <h4>{!! $chanels[0]->name !!}</h4>
    </div>


    <div class="buying">
        <div class="create_bot">
            <div class="crete_bot_form">
                <ul>
                    <li>
                        <span>{{ trans('front/MyChannel.name') }}</span>
                        <label id="chanel_name">{!! $chanels[0]->name !!}</label>
                    </li>



                    <li>
                        <span>{{ trans('front/MyChannel.description') }}</span>
                        <label id="channel_description">{!! $chanels[0]->description !!}</label>
                    </li>

                    <li>
                        <span>{{ trans('front/MyChannel.share_link') }}</span>
                        <label id="channel_share_link">{!! $chanels[0]->share_link !!}</label>
                    </li>


                </ul>
            </div>
        </div>
    </div>


</div>

<style>
    .thumb {
        width: 20%;
    }
</style>
@stop
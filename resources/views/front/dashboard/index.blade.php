@extends('front.template')
@section('main')

<div class="col-sm-3 col-sm-offset-1  col-lg-2 col-lg-offset-1 ">
    <h1 class="logo">
        <a href="{!! URL::to('/dashboard') !!}">
            {!! HTML::image('img/front/logo.png') !!}
        </a>
    </h1>

    <h3>{{ trans('front/dashboard.summary') }}</h3>
    <ul>
        <li>
            <p>
                <span>{!! count($total_bots) !!}</span>{{ trans('front/dashboard.bots') }}
            </p>
        </li>

        <li>
            <p><span>{!! count($total_chanels) !!}</span>{{ trans('front/dashboard.channels') }}</p>
        </li>
    </ul>

    <div class="new_bot_channel">
        <a class="bot_button" href="{!! URL::to('/bot/create') !!}">{!! HTML::image('img/front/plus.png') !!}</a>
        <p>{{ trans('front/dashboard.add_new_bot_chanel') }}</p>
    </div>

    <div class="summary_content">
        <h4>{{ trans('front/dashboard.bots') }}</h4>
        <p>JanaNovakova pepebotaa johanketh perivebsith.</p>
    </div>

    <div class="summary_content"><h4>{{ trans('front/dashboard.channels') }}</h4>
        <p>ChannelsNames1</p>
    </div>
</div>


<div class="col-sm-8 col-sm-offset-4 col-lg-9 col-lg-offset-3">
    @include('front.top')

    <div class="my_account">
        <h4>Jana  Novakovaa,</h4>
        <p>Checkout your latest projects and their progress.</p>
    </div>

    <div class="col-dashboard">
        <div class="col-lg-9 col-dash">
            <ul>
                <li>
                    <h4>{{ trans('front/dashboard.last') }} 30 {{ trans('front/dashboard.days') }}</h4>
                    <div data-provide="datepicker" class="input-group date date-content">
                        <input type="text" class="datepicker">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th "></span>
                        </div>
                    </div>
                </li>

                <li>
                    <h4>{{ trans('front/dashboard.recieved_message') }}</h4>
                    <a href="#">{!! HTML::image('img/front/edit.png') !!}</a>
                </li>
            </ul>

            <h3>375</h3>
            <div class="status">
                <h4>{{ trans('front/dashboard.global_statistics') }} <span>{{ trans('front/dashboard.status_measuring') }}</span></h4>

                <div class="week">
                    <select>
                        <option>{{ trans('front/dashboard.this_week') }} </option>
                        <option>{{ trans('front/dashboard.this_week') }}</option>
                        <option>{{ trans('front/dashboard.this_week') }}</option>
                        <option>{{ trans('front/dashboard.this_week') }}</option>
                    </select>
                </div>
            </div>

            <div class="graph">
                {!! HTML::image('img/front/graph_img.png') !!}
            </div>

            <div class="col-my-content">
                <h3>{{ trans('front/dashboard.my_bots') }}</h3>
                <ul class="row">
                    <?php
                    if (isset($bots) && !empty($bots)) {
                        foreach ($bots as $b1 => $bv1) {
                            ?>
                            <li class="col-sm-4">
                                <div class="days_preparing">
                                    <h4><a href="{!! URL::to('/bot/detail/'.$bv1->id) !!}">{{ $bv1->username }}</a></h4>
                                    <p class="h2"><span>215</span>
                                        {!! HTML::image('img/front/days_counting_img.png') !!}
                                    </p>
                                    <h5>{{ trans('front/dashboard.last') }} 30 {{ trans('front/dashboard.days') }}</h5>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>

                    <li class="col-sm-4">
                        <div class="days_preparing">
                            <h1 class="add_plus">{!! link_to_route('bot.create', '+', [], ['class' => '']) !!}</h1>
                        </div>
                    </li>
                </ul>

                <h3>{{ trans('front/dashboard.my_channels') }}</h3>
                <ul class="row">
                    <?php
                    if (isset($chanel) && !empty($chanel)) {
                        foreach ($chanel as $chanelKey => $myChanel) {
                            ?>
                            <li class="col-sm-4">
                                <div class="days_preparing">
                                    <h4><a href="{!! URL::to('/my_channel/detail/'.$myChanel->id) !!}">{{ $myChanel->name }}</a></h4>
                                    <p class="h2"><span>215</span>
                                        {!! HTML::image('img/front/days_counting_img.png') !!}
                                    </p>
                                    <h5>{{ trans('front/dashboard.last') }} 30 {{ trans('front/dashboard.days') }}</h5>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?> 


                    <!--                    <li class="col-sm-4">
                                            <div class="days_preparing">
                                                <h4>ChannelsName2</h4>
                                                <p class="h2"><span>215</span>
                                                    {!! HTML::image('img/front/days_counting_img.png') !!}
                                                </p>
                                                <h5>{{ trans('front/dashboard.last') }} 30 {{ trans('front/dashboard.days') }}</h5>
                                            </div>
                                        </li>-->

                    <li class="col-sm-4">
                        <div class="days_preparing">
                            <h1 class="add_plus">{!! link_to_route('my_channel.create', '+', [], ['class' => '']) !!}</h1>
                            <!--<h1 class="add_plus"><a href="#">+</a></h1>-->
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-3 side_dashboard_content">
            <h3>{{ trans('front/dashboard.recent_activity') }}</h3>
            <ul>
                <li>
                    <span>{!! HTML::image('img/front/profile_img.png') !!}</span>
                    <div class="side_content">
                        <h4>Lorum ipsum</h4>
                        <p>Lorem Ipsum proin gravida nibh vel velit phoine vel nibh nibh vel velit .</p>
                        <div class="side_time">2 hour ago</div>
                    </div>
                </li>

                <li>
                    <span>{!! HTML::image('img/front/profile_img.png') !!}</span>
                    <div class="side_content">
                        <h4>Lorum ipsum</h4>
                        <p>Lorem Ipsum proin gravida nibh vel velit phoine vel nibh nibh vel velit .</p>
                        <div class="side_time">2 hour ago</div>
                    </div>
                </li>

                <li>
                    <span>{!! HTML::image('img/front/profile_img.png') !!}</span>
                    <div class="side_content">
                        <h4>Lorum ipsum</h4>
                        <p>Lorem Ipsum proin gravida nibh vel velit phoine vel nibh nibh vel velit .</p>
                        <div class="side_time">2 hour ago</div>
                    </div>
                </li>

                <li>
                    <span>{!! HTML::image('img/front/profile_img.png') !!}</span>
                    <div class="side_content">
                        <h4>Lorum ipsum</h4>
                        <p>Lorem Ipsum proin gravida nibh vel velit phoine vel nibh nibh vel velit .</p>
                        <div class="side_time">2 hour ago</div>
                    </div>
                </li>

                <li>
                    <span>{!! HTML::image('img/front/profile_img.png') !!}</span>
                    <div class="side_content">
                        <h4>Lorum ipsum</h4>
                        <p>Lorem Ipsum proin gravida nibh vel velit phoine vel nibh nibh vel velit .</p>
                        <div class="side_time">2 hour ago</div>
                    </div>
                </li>

                <li>
                    <span>{!! HTML::image('img/front/profile_img.png') !!}</span>
                    <div class="side_content">
                        <h4>Lorum ipsum</h4>
                        <p>Lorem Ipsum proin gravida nibh vel velit phoine vel nibh nibh vel velit .</p>
                        <div class="side_time">2 hour ago</div>
                    </div>
                </li>
            </ul>

            <div class="view_log"><a href="#">{{ trans('front/dashboard.view_log') }}</a></div>
        </div>
    </div>
</div>

<!--<div class="row">

  {!! link_to_route('bot.create', trans('front/bots.create'), [], ['class' => 'btn btn-success btn-block btn']) !!}

</div>-->

@stop


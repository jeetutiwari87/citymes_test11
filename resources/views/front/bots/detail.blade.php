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
                    <span>{!! count($total_bots) !!}</span>{{ trans('front/command.bots') }}
                </p>
            </li>
            
            <li>
                <p><span>{!! count($total_chanels) !!}</span>{{ trans('front/command.channels') }}</p>
            </li>
        </ul>
        
        <div class="new_bot_channel">
            <a class="bot_button" href="{!! URL::to('/bot/create') !!}">{!! HTML::image('img/front/plus.png') !!}</a>
            <p>{{ trans('front/fornt_user.add_new_bot_chanel') }}</p>
        </div>
    </div>

    <div class="col-sm-8 col-sm-offset-4 col-lg-9 col-lg-offset-3">
     
      @include('front.top')  
      
      <div class="my_account">
        <h4>{!! $bots[0]->bot_token !!}</h4>
      </div>
      
    
      
      <div class="col-lg-12">
        <div class="col-plan">
          <h2>{{ trans('front/bots.autoresponse') }}</h2>
          <table>
            <thead>
              <tr>
                <th>{{ trans('front/bots.submenu_heading_text') }}</th>
                <th>{{ trans('front/bots.autoresponse_msg') }} </th>
                <th>{{ trans('front/bots.image') }} </th>
                <th>{{ trans('front/bots.created_at') }}</th>
                <th>{{ trans('front/bots.updated_at') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(!empty($autoResponse)){
                  foreach($autoResponse as $d2 => $v2){
                    ?>
                        <tr>
                          <td><?php echo $v2->submenu_heading_text;?></td>
                          <td><?php echo $v2->autoresponse_msg;?></td>
                          <td>
                            <?php
                              $src = '';
                              if(!empty($v2->image)){
                                $src = 'uploads/'.$v2->image;
                              }
                            ?>
                              {!! HTML::image($src,'', array('class' => 'thumb')) !!}
                          </td>
                          <td><?php echo $v2->created_at;?></td>
                          <td><?php echo $v2->updated_at;?></td>
                        </tr>
                    <?php
                  }
                }
                else{
                  ?>
                    <tr>
                      <td colspan="4">{{ trans('front/fornt_user.no_record') }}</td>
                    </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        
        <div class="col-plan">
          <h2>{{ trans('front/bots.contact_form') }}</h2>
          <table>
            <thead>
              <tr>
                <th>{{ trans('front/bots.submenu_heading_text') }}</th>
                <th>{{ trans('front/bots.headline') }} </th>
                <th>{{ trans('front/bots.created_at') }}</th>
                <th>{{ trans('front/bots.updated_at') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(!empty($contactForm)){
                  foreach($contactForm as $d3 => $v3){
                    ?>
                        <tr>
                          <td><?php echo $v3->submenu_heading_text;?></td>
                          <td><?php echo $v3->headline;?></td>
                          <td><?php echo $v3->created_at;?></td>
                          <td><?php echo $v3->updated_at;?></td>
                        </tr>
                    <?php
                  }
                }
                else{
                  ?>
                    <tr>
                      <td colspan="4">{{ trans('front/fornt_user.no_record') }}</td>
                    </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        
        <div class="col-plan">
          <h2>{{ trans('front/bots.galleries') }}</h2>
          <table>
            <thead>
              <tr>
                <th>{{ trans('front/bots.submenu_heading_text') }}</th>
                <th>{{ trans('front/bots.headline') }} </th>
                <th>{{ trans('front/bots.created_at') }}</th>
                <th>{{ trans('front/bots.updated_at') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(!empty($gallery)){
                  foreach($gallery as $d4 => $v4){
                    ?>
                        <tr>
                          <td><?php echo $v4->gallery_submenu_heading_text;?></td>
                          <td><?php echo $v4->introduction_headline;?></td>
                          <td><?php echo $v4->created_at;?></td>
                          <td><?php echo $v4->updated_at;?></td>
                        </tr>
                    <?php
                  }
                }
                else{
                  ?>
                    <tr>
                      <td colspan="4">{{ trans('front/fornt_user.no_record') }}</td>
                    </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        
        <div class="col-plan">
          <h2>{{ trans('front/bots.chanels') }}</h2>
          <table>
            <thead>
              <tr>
                <th>{{ trans('front/bots.submenu_heading_text') }}</th>
                <th>{{ trans('front/bots.chanel_msg') }} </th>
                <th>{{ trans('front/bots.image') }} </th>
                <th>{{ trans('front/bots.created_at') }}</th>
                <th>{{ trans('front/bots.updated_at') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(!empty($chanels)){
                  foreach($chanels as $d5 => $v5){
                    ?>
                        <tr>
                          <td><?php echo $v5->chanel_submenu_heading_text;?></td>
                          <td><?php echo $v5->chanel_msg;?></td>
                          <td>
                            <?php
                              $src = '';
                              if(!empty($v5->image)){
                                $src = 'uploads/'.$v5->image;
                              }
                            ?>
                              {!! HTML::image($src,'', array('class' => 'thumb')) !!}
                          </td>
                          <td><?php echo $v5->created_at;?></td>
                          <td><?php echo $v5->updated_at;?></td>
                        </tr>
                    <?php
                  }
                }
                else{
                  ?>
                    <tr>
                      <td colspan="4">{{ trans('front/fornt_user.no_record') }}</td>
                    </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        
      
</div>
      
  </div>

<style>
  .thumb {
    width: 20%;
  }
</style>
@stop
<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Contracts\Auth\User;
use Auth;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Requests\FrontUserCreateRequest;
use App\Models\FrontUser;

class FrontUserController extends Controller
{
     public function __construct() {
        parent::getTotalbot_chanel();
        
    }
    
    
    public function index(){
        $user_id = Auth::user()->id;
        $total_bots = $this->botsTOTAL;
        $total_chanels = $this->chanelTOTAL;
        
        $us_conditions = ['user_id' => $user_id];
        $botsTOTAL = DB::table('bots')->where($us_conditions)->get();

        $chanel_conditions = ['user_id' => $user_id];
        $chanelTOTAL = DB::table('my_channels')->where($us_conditions)->get();
        
        
        /******************  Bot Section  **********************************/
        $data = array();
        $bots = DB::table('bots')->get();
        if(!empty($bots)){
            foreach($bots as $b1 => $v1){
                $data[$b1]['bot']['id'] = $v1->id;
                $data[$b1]['bot']['user_id'] = $v1->user_id;
                $data[$b1]['bot']['stripe_customer_id'] = $v1->stripe_customer_id;
                $data[$b1]['bot']['first_name'] = $v1->first_name;
                $data[$b1]['bot']['last_name'] = $v1->last_name;
                $data[$b1]['bot']['username'] = $v1->username;
                $data[$b1]['bot']['bot_token'] = $v1->bot_token;
                $data[$b1]['bot']['bot_image'] = $v1->bot_image;
                $data[$b1]['bot']['bot_description'] = $v1->bot_description;
                $data[$b1]['bot']['start_message'] = $v1->start_message;
                $data[$b1]['bot']['autoresponse'] = $v1->autoresponse;
                $data[$b1]['bot']['contact_form'] = $v1->contact_form;
                $data[$b1]['bot']['galleries'] = $v1->galleries;
                $data[$b1]['bot']['channels'] = $v1->channels;
                $data[$b1]['bot']['created_at'] = $v1->created_at;
                $data[$b1]['bot']['updated_at'] = $v1->updated_at;
                
                /* user_billings */
                $user_billings = DB::table('user_billings')->where('user_id', '=', $v1->user_id)->get();

                $data[$b1]['user_billing'] = '';

                if(!empty($user_billings))
                {
                    $data[$b1]['user_billing']['id'] = $user_billings[0]->id;
                    $data[$b1]['user_billing']['user_id'] = $user_billings[0]->user_id;
                    $data[$b1]['user_billing']['address'] = $user_billings[0]->address;
                    $data[$b1]['user_billing']['street'] = $user_billings[0]->street;

                    /* country */
                    $country = DB::table('countries')->where('id', '=', $user_billings[0]->country_id)->get();

                    $data[$b1]['user_billing']['country'] = (isset($country[0]->name) && !empty($country[0]->name)?$country[0]->name:'');

                    /* state */
                    $state = DB::table('states')->where('id', '=', $user_billings[0]->state_id)->get();

                    $data[$b1]['user_billing']['state'] = (isset($state[0]->name) && !empty($state[0]->name)?$state[0]->name:'');

                    $data[$b1]['user_billing']['city'] = $user_billings[0]->city;
                    $data[$b1]['user_billing']['zipcode'] = $user_billings[0]->zipcode;
                }
                /*****************/
                
                
                /* user_subscriptions */
                $us_conditions = ['user_id' => $v1->user_id, 'types' => 'bot','type_id' => $v1->id];
                $user_subscription = DB::table('user_subscriptions')->where($us_conditions)->get();
                $data[$b1]['user_subscription'] = '';
                if(!empty($user_subscription)){
                    $data[$b1]['user_subscription']['id'] = $user_subscription[0]->id;
                    $data[$b1]['user_subscription']['user_id'] = $user_subscription[0]->user_id;
                    $data[$b1]['user_subscription']['plan_id'] = $user_subscription[0]->plan_id;
                    $data[$b1]['user_subscription']['types'] = $user_subscription[0]->types;
                    $data[$b1]['user_subscription']['type_id'] = $user_subscription[0]->type_id;
                    $data[$b1]['user_subscription']['price'] = $user_subscription[0]->price;
                    $data[$b1]['user_subscription']['subscription_date'] = $user_subscription[0]->subscription_date;
                    $data[$b1]['user_subscription']['expiry_date'] = $user_subscription[0]->expiry_date;
                    $data[$b1]['user_subscription']['last_billed'] = $user_subscription[0]->last_billed;
                    $data[$b1]['user_subscription']['status'] = $user_subscription[0]->status;
                    $data[$b1]['user_subscription']['created_at'] = $user_subscription[0]->created_at;
                    $data[$b1]['user_subscription']['updated_at'] = $user_subscription[0]->updated_at;
                    
                    $plan = DB::table('plans')->where('id', '=', $user_subscription[0]->plan_id)->get();
                    $data[$b1]['user_subscription']['Plan']['id'] = $plan[0]->id;
                    $data[$b1]['user_subscription']['Plan']['name'] = $plan[0]->name;
                }
                /*****************/
                
                
                /* user_transactions */
                $ut_conditions = ['user_id' => $v1->user_id,'types' => 'bot'];
                $user_transaction = DB::table('user_transactions')->where($ut_conditions)->get();
                
                $data[$b1]['user_transaction'] = '';
                if(!empty($user_transaction)){
                    foreach($user_transaction as $t1 => $tv1){
                        $data[$b1]['user_transaction'][$t1]['id'] = $tv1->id;
                        $data[$b1]['user_transaction'][$t1]['user_id'] = $tv1->user_id;
                        $data[$b1]['user_transaction'][$t1]['plan_id'] = $tv1->plan_id;
                        $data[$b1]['user_transaction'][$t1]['types'] = $tv1->types;
                        $data[$b1]['user_transaction'][$t1]['type_id'] = $tv1->type_id;
                        $data[$b1]['user_transaction'][$t1]['amount'] = $tv1->amount;
                        $data[$b1]['user_transaction'][$t1]['Description'] = $tv1->Description;
                        $data[$b1]['user_transaction'][$t1]['created_at'] = $tv1->created_at;
                        $data[$b1]['user_transaction'][$t1]['updated_at'] = $tv1->updated_at;
                    }
                    
                }
                /*****************/
            }
        }
        
        
        $ut_conditions = ['user_id' => $user_id,'types' => 'bot'];
        $transactions = DB::table('user_transactions')->where($ut_conditions)->get();
        
        /******************  Bot Section  **********************************/
        
        
         /******************  My chanels  **********************************/
        $my_channels = DB::table('my_channels')->get();
        $chanel_data = array();
        if(!empty($my_channels)){
            foreach($my_channels as $c1 => $c_v1){
                $chanel_data[$c1]['channel']['id'] = $c_v1->id;
                $chanel_data[$c1]['channel']['user_id'] = $c_v1->user_id;
                $chanel_data[$c1]['channel']['stripe_customer_id'] = $c_v1->stripe_customer_id;
                $chanel_data[$c1]['channel']['name'] = $c_v1->name;
                $chanel_data[$c1]['channel']['description'] = $c_v1->description;
                $chanel_data[$c1]['channel']['share_link'] = $c_v1->share_link;
                $chanel_data[$c1]['channel']['created_at'] = $c_v1->created_at;
                $chanel_data[$c1]['channel']['updated_at'] = $c_v1->updated_at;
                
                /* user_billings */
                $user_billings = DB::table('user_billings')->where('user_id', '=', $c_v1->user_id)->get();

                $chanel_data[$c1]['user_billing'] = '';

                if(!empty($user_billings))
                {
                    $chanel_data[$c1]['user_billing']['id'] = $user_billings[0]->id;
                    $chanel_data[$c1]['user_billing']['user_id'] = $user_billings[0]->user_id;
                    $chanel_data[$c1]['user_billing']['address'] = $user_billings[0]->address;
                    $chanel_data[$c1]['user_billing']['street'] = $user_billings[0]->street;

                    /* country */
                    $country = DB::table('countries')->where('id', '=', $user_billings[0]->country_id)->get();

                    $chanel_data[$c1]['user_billing']['country'] = (isset($country[0]->name) && !empty($country[0]->name)?$country[0]->name:'');

                    /* state */
                    $state = DB::table('states')->where('id', '=', $user_billings[0]->state_id)->get();

                    $chanel_data[$c1]['user_billing']['state'] = (isset($state[0]->name) && !empty($state[0]->name)?$state[0]->name:'');

                    $chanel_data[$c1]['user_billing']['city'] = $user_billings[0]->city;
                    $chanel_data[$c1]['user_billing']['zipcode'] = $user_billings[0]->zipcode;
                }
                /*****************/
                
                
                /* user_subscriptions */
                $us_conditions = ['user_id' => $c_v1->user_id, 'types' => 'Channel','type_id' => $c_v1->id];
                $user_subscription = DB::table('user_subscriptions')->where($us_conditions)->get();
                $chanel_data[$c1]['user_subscription'] = '';
                if(!empty($user_subscription)){
                    $chanel_data[$c1]['user_subscription']['id'] = $user_subscription[0]->id;
                    $chanel_data[$c1]['user_subscription']['user_id'] = $user_subscription[0]->user_id;
                    $chanel_data[$c1]['user_subscription']['plan_id'] = $user_subscription[0]->plan_id;
                    $chanel_data[$c1]['user_subscription']['types'] = $user_subscription[0]->types;
                    $chanel_data[$c1]['user_subscription']['type_id'] = $user_subscription[0]->type_id;
                    $chanel_data[$c1]['user_subscription']['price'] = $user_subscription[0]->price;
                    $chanel_data[$c1]['user_subscription']['subscription_date'] = $user_subscription[0]->subscription_date;
                    $chanel_data[$c1]['user_subscription']['expiry_date'] = $user_subscription[0]->expiry_date;
                    $chanel_data[$c1]['user_subscription']['last_billed'] = $user_subscription[0]->last_billed;
                    $chanel_data[$c1]['user_subscription']['status'] = $user_subscription[0]->status;
                    $chanel_data[$c1]['user_subscription']['created_at'] = $user_subscription[0]->created_at;
                    $chanel_data[$c1]['user_subscription']['updated_at'] = $user_subscription[0]->updated_at;
                    
                    $chanel_plan = DB::table('plans')->where('id', '=', $user_subscription[0]->plan_id)->get();
                    $chanel_data[$c1]['user_subscription']['Plan']['id'] = $chanel_plan[0]->id;
                    $chanel_data[$c1]['user_subscription']['Plan']['name'] = $chanel_plan[0]->name;
                }
                /*****************/
                
                
                /* user_transactions */
                $ut_conditions = ['user_id' => $c_v1->user_id,'types' => 'Channel'];
                $user_transaction = DB::table('user_transactions')->where($ut_conditions)->get();
                
                $data[$b1]['user_transaction'] = '';
                if(!empty($user_transaction)){
                    foreach($user_transaction as $t1 => $tv1){
                        $chanel_data[$c1]['user_transaction'][$t1]['id'] = $tv1->id;
                        $chanel_data[$c1]['user_transaction'][$t1]['user_id'] = $tv1->user_id;
                        $chanel_data[$c1]['user_transaction'][$t1]['plan_id'] = $tv1->plan_id;
                        $chanel_data[$c1]['user_transaction'][$t1]['types'] = $tv1->types;
                        $chanel_data[$c1]['user_transaction'][$t1]['type_id'] = $tv1->type_id;
                        $chanel_data[$c1]['user_transaction'][$t1]['amount'] = $tv1->amount;
                        $chanel_data[$c1]['user_transaction'][$t1]['Description'] = $tv1->Description;
                        $chanel_data[$c1]['user_transaction'][$t1]['created_at'] = $tv1->created_at;
                        $chanel_data[$c1]['user_transaction'][$t1]['updated_at'] = $tv1->updated_at;
                    }
                    
                }
                /*****************/
            }
        }
        
        $ut_conditions = ['user_id' => $user_id,'types' => 'Channel'];
        $chanel_transactions = DB::table('user_transactions')->where($ut_conditions)->get();
        /******************  My chanels  **********************************/
        
        return view('front.front_user.index',compact('data','transactions','chanel_data','chanel_transactions','total_bots','total_chanels')); 
        
    }
   
    public function edit(FrontUser $user) {
       $country = DB::table('countries')->get();
       
       $front_user = Auth::user(); 
       
       $user['id'] = $front_user->id;
       $user['first_name'] = $front_user->first_name; 
       $user['last_name'] = $front_user->last_name; 
       $user['email'] = $front_user->email; 
       $user['country_id'] = $front_user->country_id; 
       $user['zipcode'] = $front_user->zipcode; 
       $user['image'] = $front_user->image; 
       $user['mobile'] = $front_user->mobile; 
        
       return view('front.front_user.edit', compact('user','country')); 
    }
    
    public function update(FrontUserCreateRequest $request){
      // echo '<pre>';print_r($request->all());die;
        
       if($request->get('id') !=''){
		  $user = FrontUser::find($request->get('id'));
          $user->first_name = $request->get('first_name');
          $user->last_name = $request->get('last_name');
          $user->country_id = $request->get('country');
          $user->zipcode = $request->get('zipcode');
          $user->mobile = $request->get('mobile');
           
          if($request->hasFile('image'))
          {
            $error_img = $_FILES["image"]["error"];
            $img_name = $_FILES["image"]["name"];

            if($error_img == '0' && $img_name != '' )
            {
               $img_path = $_FILES["image"]["tmp_name"];
               $img_name_s = time()."_".$img_name;
               $upload_img = public_path().'/uploads/'.$img_name_s;

               move_uploaded_file($img_path,$upload_img);

               $user->image = $img_name_s;
            }
          } 
          
          if($user->save()){
            return redirect('dashboard')->with('ok', trans('front/fornt_user.created'));
          }
           else{
            return redirect('dashboard')->with('ok', trans('front/fornt_user.error'));
           }
		}
    }
    
    
}

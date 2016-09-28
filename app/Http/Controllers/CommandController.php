<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Contracts\Auth\User;
use Auth;
use App\Http\Controllers\Auth\AuthController;

use App\Models\Command;
use App\Models\Autoresponse;
use App\Models\ContactForm;
use App\Models\ContactFormQuestion;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Chanel;

class CommandController extends Controller
{
	public function __construct() {
        parent::getTotalbot_chanel();
        
    }
	
    public function create($bot_id){
		$total_bots = $this->botsTOTAL;
        $total_chanels = $this->chanelTOTAL;
		
        $botId = $bot_id;
        $userId = Auth::user()->id;
        
        $conditions = ['user_id' => $userId,'types' => 'bot','type_id' => $botId];
        $totalAutoresponses = DB::table('autoresponses')->where($conditions)->get();
        $totalContact_forms = DB::table('contact_forms')->where($conditions)->get();
        $totalGallery = DB::table('galleries')->where($conditions)->get();
        
        $subscription = DB::table('user_subscriptions')->where($conditions)->get();
        
        $planId = (isset($subscription[0]->plan_id) && !empty($subscription[0]->plan_id)?$subscription[0]->plan_id:'');
        
        if(!empty($planId))
        {
            $p_conditions = ['id' => $planId];
            $plan = DB::table('plans')->where($p_conditions)->get();
            
            return view('front.command.create',compact('botId','plan','totalAutoresponses','totalContact_forms','totalGallery','total_bots','total_chanels'));
        }
        else{
            return redirect('dashboard')->with('ok', trans('front/command.error'));
        }
    }
    
    public function store(Request $request){
        //echo '<pre>';print_r($request->all());die;

        $userId = Auth::user()->id;
        if(!empty($request->get('autoresponse')) && $request->get('autoresponse') == 1)
        {
            $autoresponse = new Autoresponse;    
            $autoresponse->types = 'bot';
            $autoresponse->type_id = $request->get('bot_id');
            $autoresponse->user_id = $userId;
            $autoresponse->submenu_heading_text = $request->get('autoresponse_submenu_heading_text');
            
            $autoresponse->autoresponse_msg = '';
            $img_name_s = '';
            if(!empty($request->get('autoresponse_msg'))){
                $autoresponse->autoresponse_msg = $request->get('autoresponse_msg');
            }
            else{
                if($request->hasFile('image')){
                    $error_img = $_FILES["image"]["error"];
                    $img_name = $_FILES["image"]["name"];

                    if($error_img == '0' && $img_name != '' )
                    {
                       $img_path = $_FILES["image"]["tmp_name"];
                       $img_name_s = time()."_".$img_name;
                       $upload_img = public_path().'/uploads/'.$img_name_s;

                       move_uploaded_file($img_path,$upload_img);
                    }
                }
            }
            
            $autoresponse->image = $img_name_s;
            $autoresponse->save();
            
            return redirect('front_user')->with('ok', trans('front/command.created'));
        }
        
        if(!empty($request->get('contact_form')) && $request->get('contact_form') == 1)
        {
            $contact_form = new ContactForm;
            
            $contact_form->types = 'bot';
            $contact_form->type_id = $request->get('bot_id');
            $contact_form->submenu_heading_text = $request->get('contact_submenu_heading_text');
            $contact_form->user_id = $userId;
            $contact_form->headline = $request->get('headline');
            
            $contact_form->save();
            
            $contact_form_id = $contact_form->id;
            
            if(!empty($contact_form_id) && count($request->get('ques_heading'))>0){
                $chk = 0;
                foreach($request->get('ques_heading') as $k1 => $v1){
                    
                    $contact_form_ques = new ContactFormQuestion;
                    $contact_form_ques->contact_form_id = $contact_form_id;
                    $contact_form_ques->ques_heading = $v1;
                    $contact_form_ques->response_type = $request->get('type_response')[$k1];
                    
                    $contact_form_ques->save();
                    $chk = 1;
                }
                
                if($chk == 1){
                    return redirect('front_user')->with('ok', trans('front/command.created'));
                }
            }
            
            return redirect('front_user')->with('ok', trans('front/command.created'));
        }
        
        if(!empty($request->get('gallery_form')) && $request->get('gallery_form') == 1)
        {
            //echo '<pre>';print_r($request->all());die;
            
            $gallery = new Gallery; 
            $gallery->types = 'bot';
            $gallery->type_id = $request->get('bot_id');
            $gallery->user_id = $userId;
            $gallery->gallery_submenu_heading_text = $request->get('gallery_submenu_heading_text');
            $gallery->introduction_headline = $request->get('introduction_headline');
            $gallery->created_at = date('Y-m-d h:i:s');
            $gallery->updated_at = date('Y-m-d h:i:s');
            
            if($gallery->save()){
                $galleryId = $gallery->id;
                
                if(!empty($request->get('title'))){
                    foreach($request->get('title') as $k1 => $v1){
                        $data = explode('_',$k1);
                        
                        $gallery_img = new GalleryImage;
                        $gallery_img->gallery_id = $galleryId;
                        $gallery_img->title = $v1;
                        $gallery_img->image = $data[0];
                        $gallery_img->sort_order = $data[1];
                        $gallery_img->created_at = date('Y-m-d h:i:s');
                        $gallery_img->updated_at = date('Y-m-d h:i:s');
                        
                        $gallery_img->save();
                    }
                }
            }
            
            return redirect('front_user')->with('ok', trans('front/command.created'));
        }
        
        
        if(!empty($request->get('chanel')) && $request->get('chanel') == 1)
        {
            //echo '<pre>';print_r($request->all());die;
            $chanel = new Chanel; 
            
            $chanel->types = 'bot';
            $chanel->type_id = $request->get('bot_id');
            $chanel->user_id = $userId;
            $chanel->chanel_submenu_heading_text = $request->get('chanel_submenu_heading_text');
            
            $chanel->chanel_msg = '';
            $img_name_s = '';
            if(!empty($request->get('chanel_msg'))){
                $chanel->chanel_msg = $request->get('chanel_msg');
            }
            else{
                if($request->hasFile('chanel_image')){
                    $error_img = $_FILES["chanel_image"]["error"];
                    $img_name = $_FILES["chanel_image"]["name"];

                    if($error_img == '0' && $img_name != '' )
                    {
                       $img_path = $_FILES["chanel_image"]["tmp_name"];
                       $img_name_s = time()."_".$img_name;
                       $upload_img = public_path().'/uploads/'.$img_name_s;

                       move_uploaded_file($img_path,$upload_img);
                    }
                }
            }
            
            $chanel->image = $img_name_s;
            $chanel->created_at = date('Y-m-d h:i:s');
            $chanel->updated_at = date('Y-m-d h:i:s');
            $chanel->save();
            
            return redirect('front_user')->with('ok', trans('front/command.created'));
        }
    }
    
    
    public function imgupload(Request $request){
      //  echo '<pre>';print_r($request->all());die;
        
        if($request->hasFile('myfile')){
            $error_img = $_FILES["myfile"]["error"];
            $img_name = $_FILES["myfile"]["name"];

            if($error_img == '0' && $img_name != '' )
            {
               $img_path = $_FILES["myfile"]["tmp_name"];
               $img_name_s = time()."-".$img_name;
               $upload_img = public_path().'/uploads/'.$img_name_s;

               if(move_uploaded_file($img_path,$upload_img)){
                echo json_encode($img_name_s);
               }
            }
        }
    }
}

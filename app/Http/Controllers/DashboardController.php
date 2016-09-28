<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\User;
use Auth;
use App\Http\Controllers\Auth\AuthController;
use Telegram\Bot\Api;

class DashboardController extends Controller {

    protected $nbrPages;

    /**
     * Create a new BlogController instance.
     *
     * @param  App\Repositories\BlogRepository $blog_gestion
     * @param  App\Repositories\UserRepository $user_gestion
     * @return void
     */
    public function __construct() {
        $this->nbrPages = 2;

        $this->middleware('user');
        
        parent::getTotalbot_chanel();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Redirection
     */
    public function index() {

        //$response = $telegram->setWebhook(['url' => 'http://local.citymes/224395586:AAGQE4hkQbS1hG2_XkflPldqMBP5jyqEOho/get_updates']);
        //$response = $telegram->getMe();
        //echo $botId = $response->getId();
        /* $botId = $response->getId();
          $firstName = $response->getFirstName();
          $username = $response->getUsername();
         */
        /* $response = $telegram->sendMessage([
          'chat_id' => '203633121',
          'text' => 'this is test'
          ]); */

        /*
          $telegram = new Api('258867258:AAEClGhWQUfo72WH6ZivfgPUtOC0eGRU2sQ');
          //$response = $telegram->setWebhook(['url' => 'https://laravel-setjeetu.c9users.io/public/258867258:AAEClGhWQUfo72WH6ZivfgPUtOC0eGRU2sQ/webhook']);


          $response = $telegram->getMe();
          $botId = $response->getId();
          $keyboard = [

          ['Autoresponses', 'Contact Forms'],
          ['Galleries', 'Channels'],

          ];

          $reply_markup = $telegram->replyKeyboardMarkup([
          'keyboard' => $keyboard,
          'resize_keyboard' => true,
          'one_time_keyboard' => false
          ]);
         */

        /* $response = $telegram->sendMessage([
          'chat_id' => '203633121',
          'text' => 'Hi ',
          'reply_markup' => $reply_markup
          ]);
          echo '<pre>';
          print_r($response);
          exit;
         */

        //    echo "<pre>"; print_r($chanel); die;
        
     
        $userId = Auth::user()->id;
        $us_conditions = ['user_id' => $userId];
        $bots = DB::table('bots')->where($us_conditions)->get();

        $chanel_conditions = ['user_id' => $userId];
        $chanel = DB::table('my_channels')->where($us_conditions)->get();
        
        
        $total_bots = $this->botsTOTAL;
        $total_chanels = $this->chanelTOTAL;
        return view('front.dashboard.index', compact('bots','chanel','total_bots', 'total_chanels'));
    }

    public function get_updates() {
        $telegram = new Api('224395586:AAGQE4hkQbS1hG2_XkflPldqMBP5jyqEOho');
        $updates = $telegram->getUpdates();
        file_put_contents(public_path() . '/updates.txt', json_encode($updates));
        echo '<pre>';
        print_r($updates);
        exit;
    }

}

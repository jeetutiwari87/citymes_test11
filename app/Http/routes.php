<?php

Route::group(['middleware' => ['web']], function () {

    // Home

    Route::get('/', 'Auth\AuthController@getLogin');
    Route::post('/', 'Auth\AuthController@postLogin');

    /* Route::get('/', [
      'uses' => 'HomeController@index',
      'as' => 'home'
      ]); */
    Route::get('language/{lang}', 'HomeController@language')->where('lang', '[A-Za-z_-]+');


    // Admin
    Route::get('admin', [
        'uses' => 'AdminController@admin',
        'as' => 'admin',
        'middleware' => 'admin'
    ]);
    Route::get('dashboard', 'DashboardController@index');


    // Blog
    // Contact
    Route::resource('contact', 'ContactController', [
        'except' => ['show', 'edit']
    ]);


    // User
    //Route::get('auth/login', 'Auth\AuthController@getLogin');
    //Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('user/sort/{role}', 'UserController@indexSort');

    Route::get('user/roles', 'UserController@getRoles');
    Route::post('user/roles', 'UserController@postRoles');

    Route::put('userseen/{user}', 'UserController@updateSeen');

    Route::post('front_user/update', 'FrontUserController@update');
    Route::resource('front_user', 'FrontUserController');

    Route::resource('user', 'UserController');

    Route::resource('plan', 'PlanController');

    Route::resource('page', 'PageController');
    Route::resource('emailtemplate', 'EmailtemplateController');

    Route::get('bot/userbot/{user_id?}', 'BotController@userbot');
    Route::get('bot/detail/{botid?}', 'BotController@detail');
    Route::get('bot/destroy/{botid?}', 'BotController@destroy');
    Route::resource('bot', 'BotController');

    Route::post('command/create/{bot_id?}', 'CommandController@create');
    Route::get('command/create/{bot_id?}', 'CommandController@create');

    Route::resource('command/upload', 'CommandController@imgupload');
    Route::resource('command', 'CommandController');

    // Routes for mychannel Controller

    Route::resource('my_channel', 'MyChannelController');
    Route::get('my_channel/detail/{cahnelId?}', 'MyChannelController@detail');
    // End


    Route::get('/bot/get_state/{country_id?}', function(Request $request, $country_id) {
        $state = DB::table('countries')->get();

        $states = DB::table('states')
                ->where('country_id', '=', $country_id)
                ->get();

        $stateHtml = '';
        $stateHtml .= '<select id="state" name="state" class="form-control">';
        $stateHtml .= '<option value="">Select State</option>';
        if (!empty($states)) {
            foreach ($states as $k1 => $v1) {
                $stateHtml .= '<option value="' . $v1->id . '">' . $v1->name . '</option>';
            }
        }
        $stateHtml .= '</select>';

        echo $stateHtml;
        die;
    });

    // Authentication routes...

    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    Route::get('auth/confirm/{token}', 'Auth\AuthController@getConfirm');

    // Resend routes...
    Route::get('auth/resend', 'Auth\AuthController@getResend');

    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    // Password reset link request routes...
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
});

Route::get('/user_images/{size}/{name}', function($size = NULL, $name = NULL) {

    if (!is_null($size) && !is_null($name)) {
        $size = explode('x', $size);
        $cache_image = Image::cache(function($image) use($size, $name) {
                    return $image->make(url('/user_images/' . $name))->resize($size[0], $size[1]);
                }, 10); // cache for 10 minutes


        return Response::make($cache_image, 200, ['Content-Type' => 'image']);
    } else {
        abort(404);
    }
});
Route::post('/{bottoken}/webhook', function () {
    $update = Telegram::commandsHandler(true);

    // Commands handler method returns an Update object.
    // So you can further process $update object 
    // to however you want.

    return 'ok';
});

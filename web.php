<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
git add 1111;

Route::match(['get','post'],'/login','LoginController@login');
Route::match(['get','post'],'/register','LoginController@register');
Route::any('/captcha', function()
{
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});

Route::post('/smscode','LoginController@sendSms');
Route::match(['get','post'],'/forgetpassword','LoginController@forgetpassword');
Route::match(['get','post'],'/setpassword','LoginController@setpassword');

Route::group(['middleware'=>'login'],function(){
    Route::get('/index','IndexController@index');
    Route::get('/info/{id}','IndexController@info');
    Route::get('/checkfinish/{id}','IndexController@check_finish');
    Route::post('/canlock','IndexController@can_lock');
    Route::get('/myplan','IndexController@myplan');
    Route::get('/master','IndexController@master');
    Route::get('/masterinfo/{id}','IndexController@master_info');
    Route::get('buy/{id}','IndexController@buy');
    Route::get('userplanmes/{id}','IndexController@myplanmes');
    Route::get('myplan/delete','IndexController@delete');
    Route::get('/isfree','IndexController@is_free');

    Route::get('formula/index','FormulaController@index');
    Route::get('formula/private','FormulaController@private');
    Route::get('formula/people_info/{id}','FormulaController@people_info');
    Route::get('formula/setting_rule/{ploy_id}','FormulaController@setting_rule');
    Route::post('formula/setting_save','FormulaController@setting_save');
    Route::get('formula/reset/{id}','FormulaController@reset');
    Route::any('formula/keep','FormulaController@keep');
    Route::post('formula/add_keep','FormulaController@add_keep');
    Route::post('formula/analogstart','FormulaController@analogStart');
    //个人中心-->
    Route::get('user/center','UserController@index');//会员中心
    Route::get('user/info/modify','UserController@modifyUserInfo');//修改资料
    Route::post('user/sendsms','UserController@sendSms');//发送手机验证码
    Route::post('user/chksms','UserController@checkSms');//校验验证码
    Route::post('user/modifypwd','UserController@resetPwd');//校验验证码
    Route::post('user/modifyphone','UserController@updatePhone');//校验验证码

    Route::get('/play','PlayController@index');
    Route::any('play/{action}', function(App\Http\Controllers\PlayController $controller, $action){
        return $controller->$action();
    });

    Route::get('user/address','UserController@getAddress');//校验验证码
    Route::get('user/help','UserController@getHelp');//帮助中心
    Route::get('help/caluhelp','UserController@getcaluhelp');//页面
    Route::get('help/caluhelp1','UserController@getcaluhelp1');//页面1
    Route::get('help/caluhelp2','UserController@getcaluhelp2');//页面1
    Route::get('help/caluhelp3','UserController@getcaluhelp3');//页面1
    Route::get('help/caluhelp4','UserController@getcaluhelp4');//页面1
    Route::get('help/caluhelp5','UserController@getcaluhelp5');//页面1
    Route::get('help/caluhelp6','UserController@getcaluhelp6');//页面1
    Route::get('connect','UserController@contactUs');//联系我们
    Route::get('user/reset','UserController@reset');//设置
    Route::get('user/reset/share','UserController@referFriends');//分享
    Route::post('share/downloadcode','UserController@downloadCode');//下载二维码
    Route::get('logout','UserController@logOut');//退出
    //充值-->
    Route::get('/recharge/payway','RechargeController@getPayWayPage');//选择支付方式


    Route::get('personal/notice','PersonalController@notice');//个人通知
    Route::get('personal/notice1','PersonalController@notice1');//个人通知
    Route::get('personal/del_notice','PersonalController@del_notice');//删除个人通知
    Route::get('personal/all_del','PersonalController@all_del');//删除全部个人通知
    Route::get('personal/read_true','PersonalController@read_true');//标记为已读
    Route::get('personal/read_all','PersonalController@read_all');//标记为已读
    Route::get('personal/info/{id}','PersonalController@info');//个人通知详情
    Route::get('notice/index','NoticeController@index');//系统公告
    Route::get('notice/notice_list','NoticeController@notice_list');//公告列表
    Route::get('notice/info/{id}','NoticeController@info');//公告详情

    //费用中心
    Route::get('cost/index','CostController@index');//列表
    Route::get('cost/recharge','CostController@recharge');//列表
    Route::get('cost/recharge_vue','CostController@recharge_vue');//列表
    Route::get('cost/cost_list','CostController@cost_list');//列表
    Route::get('cost/cost_vue','CostController@cost_vue');//列表
    Route::get('cost/unlock','CostController@unlock');//列表
    Route::get('cost/unlock_vue','CostController@unlock_vue');//列表



    //私人定制
    Route::get('made/index','MadeController@index');//列表

    //策略使用记录
    Route::get('ployuselog/index','PloyUseLogController@index');
    Route::get('ployuselog/useLogVue','PloyUseLogController@useLogVue');

});



<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('/', function(){
	return \Illuminate\Support\Facades\Redirect::to('/login');
});


Route::group(['middleware' => ['web']], function () {


Route::group(['middleware'=>'auth'],function(){

	Route::group(['middleware'=>'admin'],function(){

			Route::get('/addBlog','Controller@addblog');
			Route::get('/front','BlogController@front');
			Route::get('/comment/{id}','BlogController@comment');
			Route::post('/editBlog', 'BlogController@editBlog');
			Route::post('/insert', 'BlogController@insert');
			Route::get('/delete/{id}', 'adminController@delete');
			Route::get('/delete-comment/{id}', 'adminController@deleteComment');
			Route::get('/edit-comment/{id}', 'Controller@view_editblog');
			Route::post('/search','BlogController@search');
			Route::post('deleteRows', 'adminController@deleteRows');
			Route::get('/updateStatus/{id}/{status}', 'BlogController@updateStatus');
			Route::post('/searchBystatus','BlogController@searchBystatus');
	});

	Route::get('/home','BlogController@home');

	Route::get('/viewBlog/{id}', 'BlogController@view_blog');
	Route::post('/addcomments/{id}', 'BlogController@insertComment');
	Route::get('/logout','LoginController@Logout');
	Route::get('/', 'LoginController@check');
});
	Route::post('/home','LoginController@check');
	Route::get('/login','Controller@index');
	Route::get('/register','Controller@register');
	Route::post('get_state','Controller@get_state');
	Route::post('do_register','Controller@do_register');
	Route::any('/{all}', function(){
		return view('errors.503');
	})->where('all', '.*');

});
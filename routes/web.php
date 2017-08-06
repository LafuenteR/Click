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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
	return view('social.home')
	;
	// echo "Hello World";
});
Route::get('/profile', function ($id) {
	$user = User::find($id);
	return view('social.profile',compact('user'));
	// echo "Hello World";
});
// Route::get('/profile','Social_controller@showProfile');
Route::get('/profile/about', function () {
	return view('social.about')
	;
});
Route::get('/editprofile',function(){
	return view('social.editprofile');
});
Route::get('/home', function () {
	return view('social.home')
	;
	// echo "Hello World";
});
Route::post('/profile','Social_Controller@editprofile');

Route::post('/editAbout','Social_Controller@editAbout');

Route::get('about',function(){
	return view('social.about');
});
Route::get('/search','Social_Controller@searchAccount');

Route::get('/search','Social_Controller@searchAccount');

Route::post('/home','Social_Controller@uploadPost');

Route::get('/home','Social_Controller@showHomePost');

Route::get('/profile/{id}','Social_Controller@showProfile');


// Route::get('/profile/{id}','Social_controller@showOwn');

Route::get('/about/{id}','Social_Controller@showAbout');

Route::post('/cancelFriend/{id}','Social_Controller@cancelRequest');

Route::post('/acceptFriend/{id}','Social_Controller@acceptRequest');

Route::get('/friends/{id}','Social_Controller@showFriends');

Route::post('/like','Social_Controller@like');

Route::post('/unlike','Social_Controller@unlike');

Route::post('/unfriend/{id}','Social_Controller@unfriend');

Route::post('/addComment','Social_Controller@addcomment');

Route::post('/deletecomment','Social_Controller@deleteComment');

Route::post('/deletePost','Social_Controller@deletePost');

// Route::post('/profile/{id}','Social_controller@addForm');

// Route::get('/profile/{id}','Social_controller@showPost');
// Route::post('addFriend/{id}',function($id)
// {
// 	// $user = User::find($id);
	
// 	Auth::user()->addFriend($id);
// 	// dd($user);
// 	return view('social.profile');
// });
// Route::post('/addFriend/{id}','Social_controller@showProfile');

Route::post('/addFriend/{id}','Social_Controller@postRequest');


Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');

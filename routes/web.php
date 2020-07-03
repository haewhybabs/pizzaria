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

// Route::get('/', function () {
// 	echo \Hash::make('123456789');die;
//     //return view('welcome');
// });
// Route::get('/',function(){
// 	return view('user.login');
// });

Auth::routes();
Route::get('/test', function () {
	return view('test');
});
Route::post('/sidebar/{slug}','storeUController@sidebarSlug');

Route::match(['get', 'post'], '/verifyUser', 'Auth\RegisterController@verifyEmail')->name('user.verify')->middleware('auth');
Route::get('/resendCode','Auth\RegisterController@resendCode')->name('resendCode');

Route::group(['middleware' => 'isVerified'], function() {

	Route::get('/', 'HomeController@home');
	Route::post('load-more-data','HomeController@loadmore');
	Route::get('/home', 'HomeController@home')->name('home');
	Route::get('/contactus','contactusController@view')->name('contact.display');
	Route::post('/sendmessage','contactusController@sendmail')->name('contact.sendMessage');
	//Route::get('/stores/{slug?}','HomeController@storePage')->name('home.store');

	//Route::get('/storeLogo','HomeController@storeLogo');
	// Route::get('/stores/{id}','HomeController@storePages');

	Route::post('/search','HomeController@searchFranchise')->name('home.search');
	Route::get('/searchtype','HomeController@searchTypeAhead')->name('search.typeahead');

	Route::get('/order/{id}','HomeController@order');
	Route::get('/myaccount','profileController@userAccount')->name('myaccount');
	Route::post('/updaterprofile','profileController@update')->name('profile.update');
	Route::post('/savedetails','profileController@save')->name('profile.saveDetails');
	Route::post('/checkpass','profileController@checkPass')->name('profile.checkPass');
	Route::post('/changePass','profileController@changePass')->name('profile.changePass');
	Route::post('/checkemail','profileController@checkEmail')->name('profile.checkemail'); //for registration
	Route::post('state-list','StateController@index');
	Route::get('/add-store','HomeController@addstoreview');
	Route::post('/add-store','HomeController@addstore')->name('addstore.add');
	Route::post('store-checkphone','HomeController@checkphone')->name('addstore.checkphone');
	// Route::get('/comingsoon',function(){
	// });

	Route::post('/storelocation','HomeController@storelocation')->name('user.storeLocation'); //save location
	Route::post('/location-save','HomeController@saveLocation')->name('location.storeInSession');
	//store functions
	Route::get('/stores/{slug?}','storeUController@storeLogo')->name('home.store');
	Route::post('/store-load-more','storeUController@storeLoadmore');
	Route::get('/store/{slug}','storeUController@storeDetails')->name('home.viewStore');
	Route::post('/checkCookie','storeUController@checkCookie')->name('store.checkCookie');

	Route::post('subscribeEmail','storeUController@saveSubscriber')->name('subscribe.save');

	//search filter

	Route::post('/store-search','storeUController@searchStore')->name('store.search');
	Route::post('/company-load','storeUController@companyLoadMore')->name('store.companyload');

	Route::any('/search-filter','storeUController@search_filter')->name('store.filter');
	Route::any('/search-preference','storeUController@search_preference')->name('store.preference');
	Route::get('/order-wihtout-login','orderWithoutLoginController@storeLogo');
	// Route::get('/order-now','storeUController@orderNow');
	Route::get('/order-now','storeUController@userOrderNow');
});

Route::prefix('admin')->group(function(){
	Route::get(
	    '/login','Auth\adminLoginController@showLoginForm'
    )->name('admin.login');
	Route::post('/login','Auth\adminLoginController@login')->name('admin.login.submit');

	Route::get('/logout','Auth\adminLoginController@logout')->name('admin.logout');
	Route::get('/home','adminController@index')->name('admin.home');
	Route::get('/profile','adminController@profileView')->name('admin.profile');
	Route::post('/checkpass','adminController@checkPass')->name('admin.checkPassword');
	Route::post('/changeProfile','adminController@changeProfile')->name('admin.changeProfile');

		// user
	Route::get('users','dataentryController@userView')->name('admin.user');
	Route::post('userStatus','dataentryController@changeStatus')->name('user.changestatus');
	Route::get('dataentry','dataentryController@index')->name('admin.dataentry');
	Route::get('dataentry/add','dataentryController@add')->name('admin.dataentry.add');
	Route::post('dataentry/add','dataentryController@store')->name('admin.dataentry.store');

	Route::get('dataentry/edit/{id}','dataentryController@edit')->name('admin.dataentry.edit');
	Route::get('dataentry/delete/{id}','dataentryController@delete')->name('admin.dataentry.edit');
	Route::get('/userdelete/{id}','dataentryController@deleteuser');

	Route::post('dataentry/edit','dataentryController@update')->name('admin.dataentry.update');
	Route::get('/dashboard','adminController@index')->name('admin.dashboard');
	Route::post('/validateEmail','dataentryController@validateemail')->name('admin.validateEmail');

		//store

	Route::get('store/add','storeController@showForm')->name('store.add');
	Route::get('store/import','storeController@importForm')->name('store.import');
	Route::post('store/import','storeController@importData')->name('store.importdata');
	Route::post('store/add','storeController@storeItem')->name('store.store');

	Route::get('store/','storeController@display')->name('store.display');
	Route::post('store/getdata','storeController@getData')->name('store.getData');
	Route::get('store/edit/{id}','storeController@editForm');
	Route::post('store/edit','storeController@update')->name('store.update');
	Route::get('store/delete/{id}','storeController@delete');
	Route::get('store/view/{id}','storeController@view');
	Route::post('store/changeStaus','storeController@changeStatus')->name('store.changeStauts');
	Route::get('store/userstores','storeController@userStore')->name('store.userStore');

		//category

	Route::get('category/','categoryController@index')->name('category.display');
	Route::get('category/add','categoryController@addForm')->name('category.add');

	Route::post('category/checkname','categoryController@checkName')->name('category.checkName');
	Route::post('category/add','categoryController@store')->name('category.store');

	Route::get('category/edit/{id}','categoryController@editForm');
	Route::post('category/edit','categoryController@update')->name('category.update');

	Route::get('category/delete/{id}','categoryController@delete');

	Route::post('category/changeStatus','categoryController@changeStatus')->name('category.activeOrDis');

		//Franchies
	Route::get('Franchies/','franchiseController@index')->name('franchies.display');

	Route::get('Franchies/add','franchiseController@addForm')->name('franchies.add');
	Route::post('Franchies/checkName','franchiseController@checkName')->name('franchies.checkName');
	Route::post('Franchies/add','franchiseController@store')->name('franchies.store');

	Route::get('Franchies/edit/{id}','franchiseController@editForm')->name('franchies.edit');
	Route::post('Franchies/update','franchiseController@update')->name('franchies.update');
	Route::get('Franchies/delete/{id}','franchiseController@delete');
	Route::get('Franchies/view/{id}','franchiseController@view');
	Route::post('Franchies/changeStauts','franchiseController@changeStatus')->name('franchies.changeStauts');
	Route::get('Franchies/import','franchiseController@importForm');
	Route::post('Franchies/import-data','franchiseController@importdata')->name('franchise.importdata');

		//product
	Route::get('product/','productController@index')->name('product.display');
	Route::get('product/add','productController@addForm')->name('product.add');
	Route::POST('product/getStore','productController@getStore')->name('product.getStore');
	Route::post('product/add','productController@storeProduct')->name('product.store');

	Route::get('product/edit/{id}','productController@editForm');
	Route::post('product/update','productController@update')->name('product.update');
	Route::get('product/view/{id}','productController@view');

	Route::get('product/delete/{id}','productController@delete');

	Route::get('messages','contactusController@getMessages')->name('messages.get');
	Route::get('messages/view/{id}','contactusController@getUserMessage');
	Route::post('messages/reply','contactusController@sendReply')->name('messages.reply');
	Route::get('messages/delete/{id}','contactusController@deleteMessage');
});
// api route

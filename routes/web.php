<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NotificationController;

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

//     return view('welcome');

// });



Route::get('/','web\HomeController@index')->name('webIndexPage');

Route::any('/business-detail/{slug?}','web\HomeController@business')->name('business');

Route::any('/gallery','web\HomeController@Gallery')->name('gallery');

Route::any('/service','web\HomeController@Service')->name('service');

Route::any('/categories','web\HomeController@categories')->name('categories');

Route::any('/products/{slug?}','web\HomeController@product_two')->name('shop');

Route::any('/tournaments','web\HomeController@tournaments')->name('tournaments');

Route::any('/blogs','web\HomeController@blogs')->name('blogs');

Route::get('/blog-detail/{id}','web\HomeController@blogdetail')->name('blog-detail');

Route::get('/filter', 'web\HomeController@filter');

Route::get('/business-filter', 'web\HomeController@filters')->name('business-filter');



Route::get('/businessbycategory/{slug}','web\HomeController@businessbycategory')->name('businessbycategory');



Route::any('/terms','web\HomeController@terms')->name('terms');





// Route to view the wishlist

Route::get('/wishlist', 'web\HomeController@viewwishlist')->name('wishlistPage');



// Route to add a product to the wishlist

Route::any('/wishlist/add/{product}', 'web\HomeController@addwish')->name('addToWishlist');



// Optionally, route to remove a product from the wishlist

Route::delete('/wishlist/remove/{product}', 'web\HomeController@removewish')->name('removeFromWishlist');

// Route::any('/CheckOutPage','web\CartController@CheckOutPage')->name('CheckOutPage');





Route::get('/filtersProducts', 'web\HomeController@filtersProducts')->name('filtersProducts');



Route::get('/account/login','web\HomeController@accountLoginPage')->name('accountLoginPage');

Route::post('newsletter','web\HomeController@newsletter')->name('newsletter');

Route::get('logout', 'Auth\LoginController@logout')->name('accountLogout');

Route::get('/product-detail/{slug}_{id}','web\HomeController@productDetailPage')->name('productDetailPage');

Route::any('/reviews','web\HomeController@reviews')->name('reviews');

Route::any('/faqs','web\HomeController@faqs')->name('faqs');

Route::any('/review','web\HomeController@review')->name('review');



Route::any('/policy','web\HomeController@Policy')->name('policy');



Route::any('/updatecart','web\CartController@updatecart')->name('updatecart');

Route::any('/DeleteFromCart/{id}','web\CartController@DeleteFromCart')->name('DeleteFromCart');

Route::any('/cartPage','web\CartController@cartPage')->name('cartPage');

Route::any('/placeOrder','web\CartController@placeOrder')->name('placeOrder');

Route::any('/service-detail/{id?}','web\HomeController@Servicedetail')->name('service-detail');



Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('panel')->name('admin.')->group(function () {

    Route::get('/', 'Admin\HomeController@index')->name('panel');

    Route::get('inquiries', 'Admin\HomeController@showInquiries')->name('showInquiries');

    Route::get('free-estimate-inquiries', 'Admin\HomeController@showfreeinquiry')->name('showfreeinquiry');

    Route::get('free-estimate-inquiry/{id}', 'Admin\HomeController@displayfreeinquiry')->name('displayfreeinquiry');

    Route::delete('free-estimate-inquiry/delete/{id}', 'Admin\HomeController@destroyfreeinquiry')->name('destroyfreeinquiry');

    Route::any('deleteimage/{id}','Admin\ProductController@deleteimage')->name('deleteimage');

    Route::get('user/{id}', 'Admin\UserController@feature')->name('user.feature');


    Route::get('inquiry/{id}', 'Admin\HomeController@displayInquiry')->name('displayInquiry');

    Route::delete('inquiry/delete/{id}', 'Admin\HomeController@destroy')->name('deleteInquiry');

    Route::get('profile', 'User\ProfileController@index')->name('profile');

    Route::get('userprofile','User\ProfileController@User')->name('userprofile');

    Route::get('subscription/cancel', 'User\ProfileController@cancelSubscription')->name('endSubscription');

    Route::post('profile/{user}', 'User\ProfileController@update')->name('profileUpdate');

    Route::post('change/{user}', 'User\ProfileController@updatePassword')->name('updatePassword');

    Route::get('/mark-all-read', function(){

        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();

    });

    Route::group(['middleware' => 'role:Administrator'], function () {

        Route::resource('order', 'Admin\OrderController');



        Route::get('Orders', 'Admin\HomeController@showOrders')->name('showOrders');

        Route::post('order/{id}', 'Admin\HomeController@update');

        Route::get('Orders/{id}', 'Admin\HomeController@displayOrders')->name('displayOrders');

        Route::get('Orders/invoice/{id}', 'Admin\HomeController@Invoice')->name('Invoice');

        Route::delete('Orders/delete/{id}', 'Admin\HomeController@destroyOrders')->name('deleteOrders');

        Route::get('Orders/update/{id}', 'Admin\HomeController@update')->name('update');



        Route::post('/mark-as-read', 'Admin\HomeController@markAsNotification')->name('markAsNotification');

        Route::get('content', 'Admin\CmsController@index')->name('content');

        Route::get('banner', 'Admin\BannerController@index')->name('banner');

        Route::get('banner/{banner}', 'Admin\BannerController@edit')->name('banner.edit');

        Route::post('banner', 'Admin\BannerController@update')->name('banner.update');

        Route::post('image/{id}', 'Admin\BannerController@updateImage')->name('banner.updatePrimaryImage');

        Route::get('content/{content}', 'Admin\CmsController@edit')->name('content.edit');

        Route::post('content', 'Admin\CmsController@update')->name('content.update');

        Route::post('image/{id}', 'Admin\CmsController@updateImage')->name('content.updatePrimaryImage');

        Route::get('config', 'Admin\CmsController@config')->name('siteIdentity');

        Route::post('config', 'Admin\CmsController@updateConfig')->name('updateConfig');

        Route::post('logo', 'Admin\CmsController@updateLogo')->name('updateLogo');

        Route::post('logo-video', 'Admin\CmsController@updateLogoVideo')->name('updateLogoVideo');

        Route::post('banner/upload/{id}', 'Admin\BannerController@uploadBanner')->name('banner.upload');

        Route::get('newsletters', 'Admin\HomeController@showSubscriptions')->name('showSubscriptions');

        Route::delete('newsletter/{id}', 'Admin\HomeController@deleteSubscriptions')->name('deleteSubscriptions');

        Route::get('inquiries', 'Admin\HomeController@showInquiries')->name('showInquiries');

        Route::get('inquiry/{id}', 'Admin\HomeController@displayInquiry')->name('displayInquiry');

        Route::delete('inquiry/delete/{id}', 'Admin\HomeController@destroy')->name('deleteInquiry');

        Route::get('subscriptions', 'Admin\FinanceController@subscriptions')->name('subscriptions');

        Route::get('tournament/{id}/feature', 'Admin\TournamentController@feature')->name('tournament.feature');

        Route::resource('slider', 'Admin\SliderController');

        Route::get('business/{id}/feature', 'Admin\BusinessController@feature')->name('business.feature');

        Route::get('category/{id}/feature', 'Admin\CategoryController@feature')->name('category.feature');



      



        // Slides ROUTES

        Route::get('sliders', 'Admin\SlidersController@index')->name('sliders.index');

        Route::get('sliders/create-heading', 'Admin\SlidersController@createHeading')->name('sliders.create_heading');

        Route::post('sliders/store-heading', 'Admin\SlidersController@storeHeading')->name('sliders.store_heading');

        Route::get('sliders/{heading}/edit-heading', 'Admin\SlidersController@editHeading')->name('sliders.edit_heading');

        Route::post('sliders/update-heading/{heading}', 'Admin\SlidersController@updateHeading')->name('sliders.update_heading');

        Route::delete('sliders/delete-heading/{heading}', 'Admin\SlidersController@deleteHeading')->name('sliders.delete_heading');



       

       

        Route::get('sliders/{heading}/create-slide', 'Admin\SlidersController@createSlide')->name('sliders.create_slide');

        Route::post('sliders/{heading}/store-slide', 'Admin\SlidersController@storeSlide')->name('sliders.store_slide');

        Route::get('sliders/{heading}/show-slide', 'Admin\SlidersController@showSlide')->name('sliders.show_slide');



        Route::get('sliders/edit-slide/{slide}', 'Admin\SlidersController@editSlide')->name('sliders.edit_slide');

        Route::post('sliders/update-slide/{slide}', 'Admin\SlidersController@updateSlide')->name('sliders.update_slide');

    

        Route::delete('sliders/delete-slide/{slide}', 'Admin\SlidersController@deleteSlide')->name('sliders.delete_slide');



        Route::resource('testimonial', 'Admin\TestimonialController');

        Route::get('testimonial/{id}/feature', 'Admin\TestimonialController@feature')->name('testimonial.feature');



        Route::resource('portfolio', 'Admin\PortfolioController');

        Route::get('blog/{id}/feature', 'Admin\BlogController@feature')->name('blog.feature');

        Route::resource('blog', 'Admin\BlogController');



        // EXTRA ROUTES

        Route::resource('state', 'Admin\StateController');

        Route::resource('weight', 'Admin\WeightController');

        Route::get('reviews/{id}/feature', 'Admin\ReviewsController@feature')->name('reviews.feature');

        Route::resource('reviews', 'Admin\ReviewsController');



        Route::resource('category', 'Admin\CategoryController');

        Route::resource('subcategory', 'Admin\SubCategoryController');

        Route::resource('user', 'Admin\UserController');

    	Route::any('users/distance/{id}', 'Admin\UserController@distance');

    	Route::any('users/graph/{id}', 'Admin\UserController@graph');

        // EXTRA ROUTES

        Route::resource('banners', 'Admin\BannerController');

        Route::resource('user', 'Admin\UserController');

        Route::resource('gallery', 'Admin\GalleryController');

        Route::post('gallery/upload/{id}', 'Admin\GalleryController@uploadGallery')->name('gallery.upload');

    });

    Route::group(['middleware' => 'role:Administrator,Customer'], function () {

        Route::resource('business', 'Admin\BusinessController');

        Route::post('business-image', 'Admin\Business@descriptionImage')->name('business.descriptionImage');

        Route::get('business/{id}/show', 'Admin\BusinessController@showvariant')->name('business.showvariant');

        Route::post('business/storeVariant/{id}', 'Admin\BusinessController@storeVariant')->name('business.storeVariant');

        Route::get('business/createVariant/{id}', 'Admin\BusinessController@createVariant')->name('business.createVariant');

        Route::get('business/editVariant/{id}', 'Admin\BusinessController@editVariant')->name('business.editVariant');

        Route::any('business/updateVariant/{id}', 'Admin\BusinessController@updateVariant')->name('business.updateVariant');

        Route::delete('business/destroyvariant/{id}', 'Admin\BusinessController@destroyvariant')->name('business.destroyvariant');



    });

});

Route::prefix('user')->name('user.')->group(function () {

    Route::resource('product', 'Admin\ProductController');

    Route::group(['middleware' => 'role:Customer'], function () {





        Route::get('/', 'User\ProfileController@userDashboard')->name('userDashboard');

        Route::get('order/index', 'User\ProfileController@orderPage')->name('userOrderPage');

        Route::get('order/invoice/{id}','User\ProfileController@Invoice');

        Route::get('order/{id}', 'User\ProfileController@orderDetailPage');

        Route::get('user/{id}', 'User\ProfileController@orderDetailPage');

     





    });

});

Route::post('/addtocart','web\CartController@AddToCart')->name('addtocart');

Route::get('/addtocart','web\CartController@AddToCart')->name('addtocart');

Route::get('/cart','web\CartController@cartPage')->name('cartPage');

Route::group(['middleware'=>'auth'],function(){

    Route::any('/CheckOutPage','web\CartController@CheckOutPage')->name('CheckOutPage');

    Route::any('/add-bussiness','web\HomeController@addbussiness')->name('addbussiness');

    Route::any('/claim','web\HomeController@claim')->name('claim');



});


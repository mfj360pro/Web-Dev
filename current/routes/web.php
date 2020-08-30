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

// COMMON ROUTES
Route::get('/',             'PageController@Home');
Route::get('/contactus',    'PageController@ContactUs');
Route::get('/services',     'PageController@Services');
Route::get('/application',  'PageController@Applications');
Route::get('/get-a-quote',  'PageController@GetQuote');
Route::get('/career',       'PageController@Career');
// Route::get('/quote',        'PageController@Quote');

// MAIL
Route::match(['get', 'post'], '/email/validate',    'MailController@ValidateEmail');
Route::match(['get', 'post'], '/email/send',        'MailController@SendEmail');
Route::match(['get', 'post'], '/email/notify',      'MailController@SendNotification');

// QUOTATION
Route::match(['get', 'post'], '/quotation/validate',            'QuoteController@ValidateQuotation');
Route::match(['get', 'post'], '/quotation/create-quotation',    'QuoteController@CreateQuotation');
Route::match(['get', 'post'], '/quotation/search-services',     'QuoteController@SearchServices');
Route::match(['get', 'post'], '/quotation/test-email',          'QuoteController@TestEmail');

// ADMIN PAGES
Route::get('/admin/dashboard',      'AdminController@Dashboard');
Route::get('/admin/accounts',       'AdminController@Accounts');
Route::get('/admin/customers',      'AdminController@Customers');
Route::get('/admin/photographers',  'AdminController@Photographers');
Route::get('/admin/contents',       'AdminController@Contents');
Route::get('/admin/promos',         'AdminController@Promos');
Route::get('/admin/services',       'AdminController@Services');
Route::get('/admin/pricing',        'AdminController@Pricing');
Route::get('/admin/units',          'AdminController@Units');
Route::get('/admin/zipcodes',       'AdminController@Zipcodes');
Route::get('/admin/shoots',         'AdminController@Quotations');
Route::get('/admin/breakdown',      'AdminController@Breakdowns');
Route::get('/admin/uploader',       'AdminController@Uploader');
Route::get('/admin/status',         'AdminController@Status');

// PORTAL PAGES
Route::match(['get', 'post'], '/portal/dashboard',          'PortalController@Dashboard');
Route::match(['get', 'post'], '/portal/customers',          'PortalController@Customers');
Route::match(['get', 'post'], '/portal/shoots',             'PortalController@Quotations');
Route::match(['get', 'post'], '/portal/promos',             'PortalController@Promos');
Route::match(['get', 'post'], '/portal/breakdown',          'PortalController@Breakdowns');
Route::match(['get', 'post'], '/portal/preview',            'PortalController@Preview');
Route::match(['get', 'post'], '/portal/get-a-quote',        'PortalController@GetQuote');
Route::match(['get', 'post'], '/portal/create-quotation',   'PortalController@CreateQuotation');
Route::match(['get', 'post'], '/portal/profile',            'PortalController@Profile');

// PHOTOGRAPHER PAGES
Route::match(['get', 'post'], '/photographer/dashboard',        'PhotographerController@Dashboard');
Route::match(['get', 'post'], '/photographer/shoots',           'PhotographerController@Quotations');
Route::match(['get', 'post'], '/photographer/shoots/details',   'PhotographerController@Details');
Route::match(['get', 'post'], '/photographer/preview',          'PhotographerController@Preview');
Route::match(['get', 'post'], '/photographer/profile',          'PhotographerController@Profile');

// DESIGNER PAGES
Route::match(['get', 'post'], '/designer/dashboard',        'DesignerController@Dashboard');
Route::match(['get', 'post'], '/designer/shoots',           'DesignerController@Quotations');
Route::match(['get', 'post'], '/designer/shoots/details',   'DesignerController@Details');
Route::match(['get', 'post'], '/designer/preview',          'DesignerController@Preview');
Route::match(['get', 'post'], '/designer/profile',          'DesignerController@Profile');

// EDITOR PAGES
Route::match(['get', 'post'], '/editor/dashboard',        'EditorController@Dashboard');
Route::match(['get', 'post'], '/editor/shoots',           'EditorController@Quotations');
Route::match(['get', 'post'], '/editor/shoots/details',   'EditorController@Details');
Route::match(['get', 'post'], '/editor/preview',          'EditorController@Preview');
Route::match(['get', 'post'], '/editor/profile',          'EditorController@Profile');

// LOGIN
// ADMIN
Route::match(['get', 'post'], '/admin',                 'LoginController@AdminLogin');
Route::match(['get', 'post'], '/admin/login',           'LoginController@AdminLogin');
Route::match(['get', 'post'], '/admin/signin',          'LoginController@AdminSignIn');
Route::match(['get', 'post'], '/admin/signout',         'LoginController@AdminSignOut');
// PORTAL
Route::match(['get', 'post'], '/portal',                'LoginController@CustomerLogin');
Route::match(['get', 'post'], '/portal/login',          'LoginController@CustomerLogin');
Route::match(['get', 'post'], '/portal/signin',         'LoginController@CustomerSignIn');
Route::match(['get', 'post'], '/portal/signout',        'LoginController@CustomerSignOut');
// PHOTOGRAPHER
Route::match(['get', 'post'], '/photographer',          'LoginController@PhotographerLogin');
Route::match(['get', 'post'], '/photographer/login',    'LoginController@PhotographerLogin');
Route::match(['get', 'post'], '/photographer/signin',   'LoginController@PhotographerSignIn');
Route::match(['get', 'post'], '/photographer/signout',  'LoginController@PhotographerSignOut');
// DESIGNER
Route::match(['get', 'post'], '/designer',              'LoginController@DesignerLogin');
Route::match(['get', 'post'], '/designer/login',        'LoginController@DesignerLogin');
Route::match(['get', 'post'], '/designer/signin',       'LoginController@DesignerSignIn');
Route::match(['get', 'post'], '/designer/signout',      'LoginController@DesignerSignOut');
// EDITOR
Route::match(['get', 'post'], '/editor',              'LoginController@EditorLogin');
Route::match(['get', 'post'], '/editor/login',        'LoginController@EditorLogin');
Route::match(['get', 'post'], '/editor/signin',       'LoginController@EditorSignIn');
Route::match(['get', 'post'], '/editor/signout',      'LoginController@EditorSignOut');

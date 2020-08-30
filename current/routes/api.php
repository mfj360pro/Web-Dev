<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// TEST QUERRIES
Route::match(['get', 'post'], 'TestQ',    'WebService@TestQ');

// SIGN-IN
Route::match(['get', 'post'], 'SignInAdmin',        'WebService@SignInAdmin');
Route::match(['get', 'post'], 'SignInCustomer',     'WebService@SignInCustomer');
Route::match(['get', 'post'], 'SignInPhotographer', 'WebService@SignInPhotographer');
Route::match(['get', 'post'], 'SignInDesigner',     'WebService@SignInDesigner');
Route::match(['get', 'post'], 'SignInEditor',       'WebService@SignInEditor');

// ================================================================================================

// ACCOUNT
Route::match(['get', 'post'], 'ReadAccounts',       'WebService@ReadAccounts');
Route::match(['get', 'post'], 'ReadAccount',        'WebService@ReadAccount');
Route::match(['get', 'post'], 'UpsertAccount',      'WebService@UpsertAccount');
Route::match(['get', 'post'], 'UpdateAccountInfo',  'WebService@UpdateAccountInfo');
Route::match(['get', 'post'], 'UpdateCompanyInfo',  'WebService@UpdateCompanyInfo');
Route::match(['get', 'post'], 'DeleteAccount',      'WebService@DeleteAccount');

// BREAKDOWNS
Route::match(['get', 'post'], 'ReadBreakdown',      'WebService@ReadBreakdown');
Route::match(['get', 'post'], 'UpsertBreakdown',    'WebService@UpsertBreakdown');
Route::match(['get', 'post'], 'DeleteBreakdown',    'WebService@DeleteBreakdown');

// CONTENT
Route::match(['get', 'post'], 'ReadContents',            'WebService@ReadContents');
Route::match(['get', 'post'], 'ReadContentsWithOwner',   'WebService@ReadContentsWithOwner');
Route::match(['get', 'post'], 'CreateContent',           'WebService@CreateContent');
Route::match(['get', 'post'], 'UpdateContent',           'WebService@UpdateContent');
Route::match(['get', 'post'], 'UpsertContent',           'WebService@UpsertContent');
Route::match(['get', 'post'], 'UpdateContentWithOwner',  'WebService@UpdateContentWithOwner');
Route::match(['get', 'post'], 'DeleteContent',           'WebService@DeleteContent');

// CUSTOMERS
Route::match(['get', 'post'], 'ReadCustomers',   'WebService@ReadCustomers');
Route::match(['get', 'post'], 'ReadCustomer',    'WebService@ReadCustomer');
Route::match(['get', 'post'], 'UpsertCustomer',  'WebService@UpsertCustomer');
Route::match(['get', 'post'], 'DeleteCustomer',  'WebService@DeleteCustomer');

// CUSTOMER PROMOS
Route::match(['get', 'post'], 'ReadCustomerPromos',     'WebService@ReadCustomerPromos');
Route::match(['get', 'post'], 'UpsertCustomerPromo',    'WebService@UpsertCustomerPromo');
Route::match(['get', 'post'], 'ReadCustomersByPromo',   'WebService@ReadCustomersByPromo');
Route::match(['get', 'post'], 'DeleteCustomerPromo',    'WebService@DeleteCustomerPromo');

// FILE UPLOAD
Route::match(['get', 'post'], 'UploadFile',             'WebService@UploadFile');
Route::match(['get', 'post'], 'FileDownloadPageUpload', 'WebService@FileDownloadPageUpload');

// LOGS
Route::match(['get', 'post'], 'LogAccount',     'WebService@LogAccount');
Route::match(['get', 'post'], 'LogCustomer',    'WebService@LogCustomer');

// MAIL
Route::match(['get', 'post'], 'PingEmail',  'WebService@PingEmail');

// MENUS
Route::match(['get', 'post'], 'ReadMenusByRole',  'WebService@ReadMenusByRole');

// NOTIFICATIONS
Route::match(['get', 'post'], 'ReadAccountNotifications',       'WebService@ReadAccountNotifications');
Route::match(['get', 'post'], 'ReadPhotographerNotifications',  'WebService@ReadPhotographerNotifications');

// PHOTOGRAPHERS
Route::match(['get', 'post'], 'ReadPhotographers',  'WebService@ReadPhotographers');
Route::match(['get', 'post'], 'ReadPhotographer',   'WebService@ReadPhotographer');
Route::match(['get', 'post'], 'UpsertPhotographer', 'WebService@UpsertPhotographer');
Route::match(['get', 'post'], 'DeletePhotographer', 'WebService@DeletePhotographer');

// PHOTOGRAPHERS - ZIPCODES
Route::match(['get', 'post'], 'ReadPhotographerZipcodes',   'WebService@ReadPhotographerZipcodes');
Route::match(['get', 'post'], 'UpsertPhotographerZipcode',  'WebService@UpsertPhotographerZipcode');
Route::match(['get', 'post'], 'DeletePhotographerZipcode',  'WebService@DeletePhotographerZipcode');

// PHOTOS
// Route::match(['get', 'post'], 'GetMetaPhoto',       'WebService@GetMetaPhoto');
// Route::match(['get', 'post'], 'ReadPhotos',         'WebService@ReadPhotos');
// Route::match(['get', 'post'], 'CreatePhoto',        'WebService@CreatePhoto');
// Route::match(['get', 'post'], 'UpdatePhoto',        'WebService@UpdatePhoto');
// Route::match(['get', 'post'], 'UpdatePhotoOrder',   'WebService@UpdatePhotoOrder');
// Route::match(['get', 'post'], 'DeletePhoto',        'WebService@DeletePhoto');
// Route::match(['get', 'post'], 'SetPhoto',           'WebService@SetPhoto');

// PRICING
Route::match(['get', 'post'], 'ReadPricings',           'WebService@ReadPricings');
Route::match(['get', 'post'], 'ReadPricing',            'WebService@ReadPricing');
Route::match(['get', 'post'], 'ReadPricingByService',   'WebService@ReadPricingByService');
Route::match(['get', 'post'], 'ReadPricingByZipcode',   'WebService@ReadPricingByZipcode');
Route::match(['get', 'post'], 'UpsertPricing',          'WebService@UpsertPricing');
Route::match(['get', 'post'], 'DeletePricing',          'WebService@DeletePricing');

// PROMOS
Route::match(['get', 'post'], 'ReadPromos',   'WebService@ReadPromos');
Route::match(['get', 'post'], 'UpsertPromo',  'WebService@UpsertPromo');
Route::match(['get', 'post'], 'DeletePromo',  'WebService@DeletePromo');

// QUOTATIONS
Route::match(['get', 'post'], 'ReadQuotations',                 'WebService@ReadQuotations');
Route::match(['get', 'post'], 'ReadQuotation',                  'WebService@ReadQuotation');
Route::match(['get', 'post'], 'ReadQuotedCustomer',             'WebService@ReadQuotedCustomer');
Route::match(['get', 'post'], 'ReadAvailableQuotations',        'WebService@ReadAvailableQuotations');
Route::match(['get', 'post'], 'AssignQuotation',                'WebService@AssignQuotation');
Route::match(['get', 'post'], 'ReadCustomerQuotations',         'WebService@ReadCustomerQuotations');
Route::match(['get', 'post'], 'ReadPhotographerQuotations',     'WebService@ReadPhotographerQuotations');
Route::match(['get', 'post'], 'UpsertQuotation',                'WebService@UpsertQuotation');
Route::match(['get', 'post'], 'UpdateQuotationStatusById',      'WebService@UpdateQuotationStatusById');
Route::match(['get', 'post'], 'UpdateQuotationStatusByFlow',    'WebService@UpdateQuotationStatusByFlow');
Route::match(['get', 'post'], 'DeleteQuotation',                'WebService@DeleteQuotation');

// ROLES
Route::match(['get', 'post'], 'ReadRoles',   'WebService@ReadRoles');
Route::match(['get', 'post'], 'UpsertRole',  'WebService@UpsertRole');
Route::match(['get', 'post'], 'DeleteRole',  'WebService@DeleteRole');

// SERVICES
Route::match(['get', 'post'], 'ReadServices',   'WebService@ReadServices');
Route::match(['get', 'post'], 'SaveService',    'WebService@SaveService');
Route::match(['get', 'post'], 'DeleteService',  'WebService@DeleteService');

// SERVICE TYPES
Route::match(['get', 'post'], 'ReadServiceTypes',   'WebService@ReadServiceTypes');
Route::match(['get', 'post'], 'UpsertServiceType',  'WebService@UpsertServiceType');
Route::match(['get', 'post'], 'DeleteServiceType',  'WebService@DeleteServiceType');

// SHOOTS
Route::match(['get', 'post'], 'ReadShootsByAccount',                'WebService@ReadShootsByAccount');
Route::match(['get', 'post'], 'ReadShootsByCustomer',               'WebService@ReadShootsByCustomer');
Route::match(['get', 'post'], 'ReadShootsByStatusAndCompletion',    'WebService@ReadShootsByStatusAndCompletion');
Route::match(['get', 'post'], 'UpdateShootStatusAndHandler',        'WebService@UpdateShootStatusAndHandler');
Route::match(['get', 'post'], 'MarkShootAsCompleteByHandler',       'WebService@MarkShootAsCompleteByHandler');
Route::match(['get', 'post'], 'MarkAsMyShoot',                      'WebService@MarkAsMyShoot');
Route::match(['get', 'post'], 'MarkShootAsReady',                   'WebService@MarkShootAsReady');

// STATUS
Route::match(['get', 'post'], 'ReadStatus',    'WebService@ReadStatus');
Route::match(['get', 'post'], 'UpsertStatus',  'WebService@UpsertStatus');
Route::match(['get', 'post'], 'DeleteStatus',  'WebService@DeleteStatus');

// TYPES
Route::match(['get', 'post'], 'ReadTypes',    'WebService@ReadTypes');
Route::match(['get', 'post'], 'UpsertTypes',  'WebService@UpsertTypes');
Route::match(['get', 'post'], 'DeleteTypes',  'WebService@DeleteTypes');

// UPLOADS
Route::match(['get', 'post'], 'ReadUploadsByBreakdown', 'WebService@ReadUploadsByBreakdown');
Route::match(['get', 'post'], 'ReadUploadsByQuotation', 'WebService@ReadUploadsByQuotation');
Route::match(['get', 'post'], 'UploadContent',          'WebService@UploadContent');
Route::match(['get', 'post'], 'UpsertUploadedContent',  'WebService@UpsertUploadedContent');
Route::match(['get', 'post'], 'DeleteUploadedContent',  'WebService@DeleteUploadedContent');

// UNITS
Route::match(['get', 'post'], 'ReadUnits',   'WebService@ReadUnits');
Route::match(['get', 'post'], 'UpsertUnit',  'WebService@UpsertUnit');
Route::match(['get', 'post'], 'DeleteUnit',  'WebService@DeleteUnit');

// ZIPCODES
Route::match(['get', 'post'], 'ReadZipcodes',   'WebService@ReadZipcodes');
Route::match(['get', 'post'], 'UpsertZipcode',  'WebService@UpsertZipcode');
Route::match(['get', 'post'], 'DeleteZipcode',  'WebService@DeleteZipcode');

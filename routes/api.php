<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/**
 *
 *
 *
 *
 *
 *ROUTES LIEES A L'AUTHENTIFICATION DU SUPERADMIN
 *
 *
 *
 *
 *
 */


/**
 * ROUTES HORS CONNEXION
 */

Route::controller(\App\Http\Controllers\SuperAdmin\SuperAdminAuthController::class)
    ->name('superAdmin.')
    ->prefix('superadmin')
    ->group(function (){

        Route::post('/login', 'login')->name('login');

        Route::get('/default', 'default')->name('default');

        Route::post('/password-reset-while-dissconnected-init', 'password_reset_while_dissconnected_init')->name('password_reset_while_dissconnected_init');
        Route::patch('/password-reset-while-dissconnected-process', 'password_reset_while_dissconnected_process')->name('password_reset_while_dissconnected_process');



    });

/**
 *ROUTES AVEC CONNEXION
 */
Route::controller(\App\Http\Controllers\SuperAdmin\SuperAdminAuthController::class)
    ->name('superAdmin.')
    ->middleware(\App\Http\Middleware\SuperAdminMiddleware::class)
    ->prefix('superadmin')
    ->group(function ()
    {

        Route::post('/otp-request', 'otp_request')->name('otp_request');
        Route::patch('/default-erase', 'default_erase')->name('default_erase');


        Route::post('/password-reset-while-connected-init', 'password_reset_while_connected_init')->name('password_reset_while_connected_init');
        Route::patch('/password-reset-while-connected-process', 'password_reset_while_connected_process')->name('password_reset_while_connected_process');


        Route::post('/email-reset-init', 'email_reset_init')->name('email_reset_init');
        Route::patch('/email-reset-process', 'email_reset_process')->name('email_reset_process');


        Route::delete('/logout', 'logout')->name('logout');


    });

/**
 *
 *
 *
 *
 *
 *ROUTES LIEES AUX FONCTIONNALITES  DU SUPERADMIN
 *
 *
 *
 *
 *
 */

Route::controller(\App\Http\Controllers\SuperAdmin\GestionAdminController::class)
    ->name('superAdmin.')
    ->middleware(\App\Http\Middleware\SuperAdminMiddleware::class)
    ->prefix('superadmin')
    ->group(function ()
    {
        Route::get('admin-list', 'admin_list')->name('admin_list');

        Route::post('admin-create', 'admin_create')->name('admin_create');

        Route::patch('admin-edit', 'admin_edit')->name('admin_edit');

        Route::delete('admin-delete', 'admin_delete')->name('admin_delete');
    });





/**
 *
 *
 *
 *
 *
 *ROUTES LIEES A L'AUTHENTIFICATION DE L'ADMIN
 *
 *
 *
 *
 *
 */


/**
 * ROUTES HORS CONNEXION
 */

Route::controller(\App\Http\Controllers\Admin\AdminAuthController::class)
    ->name('admin.')
    ->prefix('admin')
    ->group(function (){

        Route::post('/signin-init', 'signin_init')->name('signin_init');
        Route::patch('/signin-process', 'signin_process')->name('signin_process');


        Route::post('/login', 'login')->name('login');


        Route::post('/password-reset-while-dissconnected-init', 'password_reset_while_dissconnected_init')->name('password_reset_while_dissconnected_init');
        Route::patch('/password-reset-while-dissconnected-process', 'password_reset_while_dissconnected_process')->name('password_reset_while_dissconnected_process');



    });

/**
 *ROUTES AVEC CONNEXION
 */
Route::controller(\App\Http\Controllers\Admin\AdminAuthController::class)
    ->name('admin.')
    ->middleware(\App\Http\Middleware\AdminMiddleware::class)
    ->prefix('admin')
    ->group(function ()
    {


        Route::delete('/logout', 'logout')->name('logout');

        Route::post('/password-reset-while-connected-init', 'password_reset_while_connected_init')->name('password_reset_while_connected_init');
        Route::patch('/password-reset-while-connected-process', 'password_reset_while_connected_process')->name('password_reset_while_connected_process');


        Route::post('/email-reset-init', 'email_reset_init')->name('email_reset_init');
        Route::patch('/email-reset-process', 'email_reset_process')->name('email_reset_process');




    });

/**
 *
 *
 *
 *
 *
 *ROUTES LIEES AUX FONCTIONNALITES  DE L'ADMIN
 *
 *
 *
 *
 *
 */



/**
 *Gestion des packages
 */
Route::controller(\App\Http\Controllers\Admin\AdminGestionPackController::class)
    ->name('admin.')
    ->middleware(\App\Http\Middleware\AdminMiddleware::class)
    ->prefix('admin')
    ->group(function (){
        Route::get('package-list', 'package_list')->name('package_list');

        Route::post('package-create', 'package_create')->name('package_create');

        Route::patch('package-edit', 'package_edit')->name('package_edit');

        Route::delete('package-delete', 'package_delete')->name('package_delete');

        Route::patch('package-restore', 'package_restore')->name('package_restore');

        Route::patch('certif-attach', 'attach_certif')->name('attach_certif');
        Route::patch('certif-detach', 'detach_certif')->name('detach_certif');
    });





/**
 *Gestion des certifications
 */
Route::controller(\App\Http\Controllers\Admin\AdminGestionCertifController::class)
    ->name('admin.')
    ->middleware(\App\Http\Middleware\AdminMiddleware::class)
    ->prefix('admin')
    ->group(function (){
        Route::get('certif-list', 'certif_list')->name('certif_list');

        Route::post('certif-create', 'certif_create')->name('certif_create');

        Route::patch('certif-edit', 'certif_edit')->name('certif_edit');

        Route::delete('certif-delete', 'certif_delete')->name('certif_delete');

        Route::patch('certif-restore', 'certif_restore')->name('certif_restore');
    });


/**
 *Gestion des évènements
 */
Route::controller(\App\Http\Controllers\Admin\AdminGestionEventController::class)
    ->name('admin.')
    ->middleware(\App\Http\Middleware\AdminMiddleware::class)
    ->prefix('admin')
    ->group(function (){
        Route::get('event-list', 'event_list')->name('event_list');

        Route::post('event-create', 'event_create')->name('event_create');

        Route::patch('event-edit', 'event_edit')->name('event_edit');

        Route::delete('event-delete', 'event_delete')->name('event_delete');

        Route::patch('event-restore', 'event_restore')->name('event_restore');
    });


/**
 *Gestion des certifications
 */
Route::controller(\App\Http\Controllers\Admin\AdminDashboardController::class)
    ->name('admin.')
    ->middleware(\App\Http\Middleware\AdminMiddleware::class)
    ->prefix('admin/dashboard')
    ->group(function (){

        Route::get('calendrier', 'getAchatCalendrier')->name('getAchatCalendrier');

        Route::get('packages', 'getPacksWithCertifsAndBuyers')->name('getPacksWithCertifsAndBuyers');

        Route::get('certifs', 'getCertifsWithBuyers')->name('getCertifsWithBuyers');

        Route::get('find-payment', 'findPayment')->name('findPayment');
    });




/**
 *
 *
 *
 *
 * ROUTES DE L'UTILISATEUR NON CONNECTE
 *
 *
 *
 *
 */


/**
 *Presenttion des events, certifs et package et soumission du contact us
 */
Route::controller(\App\Http\Controllers\GuestController::class)
    ->name('guest.')
    ->prefix('guest')
    ->group(function (){

        Route::get('package-certif-list', 'package_certif_list')->name('package_certif_list');

        Route::get('event-list', 'event_list')->name('event_list');

        Route::post('contact-us', 'contactUs')->name('contactUs');

    });

/**
 *Payement de packages et de certif
 */

Route::controller(\App\Http\Controllers\PaymentController::class)
    ->name('guest.')
    ->prefix('guest')
    ->group(function () {

        Route::post('payment-init', 'initPayment')->name('initPayment');
        Route::post('return-after-payment', 'returnAfterPayment')->name('returnAfterPayment');
        Route::get('return-after-payment', 'returnAfterPayment')->name('returnAfterPayment');
        Route::post('payment_notify', 'notifyPayment')->name('notifyPayment');

    });


//
///**
// *GESTION DES CLIENTS
// */
//
//Route::controller(\App\Http\Controllers\Admin\AdminManageClientController::class)
//    ->name('admin.')
//    ->$this->middleware(\App\Http\Middleware\AdminMiddleware::class)
//    ->prefix('admin')
//    ->group(function ()
//    {
//        Route::get('/client-list', 'clientList')->name('clientList');
//
//        Route::get('/client-ban-list', 'clientBanList')->name('clientBanList');
//
//        Route::patch('/client-ban', 'clientBan')->name('clientBan');
//
//        Route::patch('/client-unban', 'clientUnBan')->name('clientUnBan');
//
//
//    });
//
//
//

//
///**
// *
// *
// *
// *
// *
// *ROUTES LIEES A L'AUTHENTIFICATION DU CLIENT
// *
// *
// *
// *
// *
// */
//
//
///**
// * ROUTES HORS CONNEXION
// */
//
//Route::controller(App\Http\Controllers\Client\ClientAuthController::class)
//    ->name('client.')
//    ->prefix('client')
//    ->group(function (){
//
//        Route::post('/signin-init', 'signin_init')->name('signin_init');
//        Route::post('/signin-process', 'signin_process')->name('signin_process');
//
//
//        Route::post('/login', 'login')->name('login');
//
//
//        Route::post('/password-reset-while-dissconnected-init', 'password_reset_while_dissconnected_init')->name('password_reset_while_dissconnected_init');
//        Route::patch('/password-reset-while-dissconnected-process', 'password_reset_while_dissconnected_process')->name('password_reset_while_dissconnected_process');
//
//
//
//    });
//
///**
// *ROUTES AVEC CONNEXION
// */
//Route::controller(App\Http\Controllers\Client\ClientAuthController::class)
//    ->name('client.')
//    ->middleware('client')
//    ->prefix('client')
//    ->group(function ()
//    {
//
//
//        Route::delete('/logout', 'logout')->name('logout');
//
//        Route::post('/password-reset-while-connected-init', 'password_reset_while_connected_init')->name('password_reset_while_connected_init');
//        Route::patch('/password-reset-while-connected-process', 'password_reset_while_connected_process')->name('password_reset_while_connected_process');
//
//
//        Route::post('/email-reset-init', 'email_reset_init')->name('email_reset_init');
//        Route::patch('/email-reset-process', 'email_reset_process')->name('email_reset_process');
//
//
//
//
//    });
//
///**
// *
// *
// *
// *
// *
// *ROUTES LIEES AUX FONCTIONNALITES  DU CLIENT
// *
// *
// *
// *
// *
// */
//
//Route::controller(App\Http\Controllers\Client\ClientAuthController::class)
//    ->name('client.')
//    ->middleware('client')
//    ->prefix('client')
//    ->group(function ()
//    {
//
//    });






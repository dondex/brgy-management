<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return redirect('/home');
});

// AUTHENTICATION
Route::get('/createadmin', [AuthController::Class, 'createAdmin']);

Route::get('/login', function () {
    if (session()->has('user_id')){
        return redirect('/home');        
    }else{
        return view('authentication.login');
    }
});

Route::post('/gologin', [AuthController::Class, 'login']);

Route::get('/forgot', function(){
    return view('authentication.forgot');
});

Route::post('/code', [AuthController::Class, 'sendCode']);

Route::post('/reset', [AuthController::Class, 'checkCode']);

Route::post('/newpass', [AuthController::Class, 'resetPass']);

Route::get('/changepass', function(){
    if (Session()->missing('user_id')){
        return redirect('/home');        
    }else{
        return view('authentication.changepass');
    }
});

Route::post('/changepass/new', [AuthController::Class, 'changePass']);

Route::get('/signup', function () {
    if (Session()->has('user_id')){
        return redirect('/home');        
    }else{
        return view('authentication.signup');
    }
});

Route::post('/gosignup', [AuthController::Class, 'signup']);

Route::get('/logout', [AuthController::Class, 'logout']);

// ADMIN

Route::get('/dashboard', [DashboardController::Class, 'getDashboard']);

Route::get('/resident/accept/{resident_id}', [DashboardController::Class, 'acceptVerify']);

Route::get('/resident/decline/{resident_id}', [DashboardController::Class, 'declineVerify']);

Route::get('/announcement', [AnnouncementController::Class, 'getAnnouncements']);

Route::post('/announcement/post', [AnnouncementController::Class, 'postAnnouncement']);

Route::post('/announcement/update', [AnnouncementController::Class, 'updateAnnouncement']);

Route::get('/announcement/delete/{announcement_id}', [AnnouncementController::Class, 'deleteAnnouncement']);

Route::get('/resident', [ResidentController::Class, 'getResidents']);

Route::get('/document', [DocumentController::Class, 'getDocuments']);

Route::post('/document/approve', [DocumentController::Class, 'approveDocument']);

Route::get('/document/approve/{document_id}', [DocumentController::Class, 'approveDocument']);

Route::get('/document/decline/{document_id}', [DocumentController::Class, 'declineDocument']);

Route::get('/official', [OfficialController::Class, 'getOfficial']);

Route::get('/official/{year}', [OfficialController::Class, 'getOfficial']);

Route::post('/official/update', [OfficialController::Class, 'updateOfficial']);

Route::post('/official/archive', [OfficialController::Class, 'archiveOfficial']);

// RESIDENT

Route::get('/home', [AnnouncementController::Class, 'getLandingAnnouncements']);

Route::get('/request/document', [DocumentController::Class, 'canRequestDocs']);

Route::post('/requestdoc', [DocumentController::Class, 'requestDocument']);

Route::get('/profile', [ResidentController::Class, 'getResidentProfile']);

Route::post('/goupdateprofile', [ResidentController::Class, 'updateProfile']);

Route::get('/about', [OfficialController::Class, 'getOfficialPublic']);

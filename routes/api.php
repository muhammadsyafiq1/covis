<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TransactionController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/customer', [CustomerController::class, 'all']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-login', [AuthController::class, 'checkLoggedIn']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/data-statistik', [TransactionController::class, 'statistik']);
    Route::get('/last-visit', [TransactionController::class, 'lastVisit']);
    Route::get('/unscheduled-task', [TransactionController::class, 'unscheduled_task']);
    Route::get('/completed-task', [TransactionController::class, 'completedTask']);
    Route::get('/scheduled-task', [TransactionController::class, 'scheduled_task']);
    Route::get('/detail-scheduled-task/{id}', [TransactionController::class, 'detailScheduledTask']);
    Route::get('/detail', [AuthController::class, 'detail']);
    Route::get('/user-lod', [UserController::class, 'getLOD']);
    Route::get('/transaction-images/{id}', [TransactionController::class, 'getImages']);
    Route::get('/transaction-revision', [TransactionController::class, 'getTransactionRevision']);
    Route::get('/transaction-completed', [TransactionController::class, 'getTransactionCompleted']);
    Route::get('/rating-surveyor', [TransactionController::class, 'ratingSurveyor']);
    Route::get('/check-photo/{id}', [TransactionController::class, 'checkPhoto']);
    Route::post('/detail-unscheduled-task', [TransactionController::class, 'detailUnscheduledTask']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-schedule', [TransactionController::class, 'updateSchedule']);
    Route::post('/ready-to-visit', [TransactionController::class, 'readyToVisit']);
    Route::post('/revision-visit', [TransactionController::class, 'revisionVisit']);
    Route::post('/update-phone-number', [UserController::class, 'updatePhone']);
    Route::post('/update-password', [UserController::class, 'updatePassword']);
    Route::post('/post-images-visits', [TransactionController::class, 'postImage']);
    
    // permethod
        Route::post('/post-images-visits-depan1', [TransactionController::class, 'depan1']);
        Route::post('/post-images-visits-depan2', [TransactionController::class, 'depan2']);
        Route::post('/post-images-visits-right', [TransactionController::class, 'right']);
        Route::post('/post-images-visits-left', [TransactionController::class, 'left']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\EquipmentController;

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

// Route::get('/data', [TestController::class, 'index']);

Route::group(['prefix' => 'test', 'as' => 'test.'], function () {
    // 全ての商品データ取得
    Route::get('/data', [TestController::class, 'index']);
});

// 社員
Route::group(['prefix' => 'employee', 'as' => 'employee.'], function () {
    // 全ての社員データ取得
    Route::get('/all', [EmployeeController::class, 'index']);
    // 新規社員データ登録
    Route::post('/add', [EmployeeController::class, 'store']);
    // 対象データ検索
    Route::post('/search', [EmployeeController::class, 'search']);
    // 社員ID取得して編集
    Route::get('/edit/{id}', [EmployeeController::class, 'edit']);
    // 取得した社員IDで更新
    Route::post('/update/{id}', [EmployeeController::class, 'update']);
    // 社員IDで削除
    Route::post('/delete/{id}', [EmployeeController::class, 'destroy']);
    // 複数社員IDで削除
    Route::post('/deleteAll', [EmployeeController::class, 'deleteAll']);
});

// 住所
Route::group(['prefix' => 'address', 'as' => 'address.'], function () {
    // 全ての住所データ取得
    Route::get('/all', [AddressController::class, 'index']);
    // 新規住所データ登録
    Route::post('/add', [AddressController::class, 'store']);
    // 対象データ検索
    Route::post('/search', [AddressController::class, 'search']);
    // 住所ID取得して編集
    Route::get('/edit/{id}', [AddressController::class, 'edit']);
    // 取得した住所IDで更新
    Route::post('/update/{id}', [AddressController::class, 'update']);
    // 住所IDで削除
    Route::post('/delete/{id}', [AddressController::class, 'destroy']);
    // 複数住所IDで削除
    Route::post('/deleteAll', [AddressController::class, 'deleteAll']);
});

// 備品
Route::group(['prefix' => 'equipment', 'as' => 'equipment.'], function () {
    // 全ての備品データ取得
    Route::get('/all', [EquipmentController::class, 'index']);
    // 新規備品データ登録
    Route::post('/add', [EquipmentController::class, 'store']);
    // 対象データ検索
    Route::post('/search', [EquipmentController::class, 'search']);
    // 備品ID取得して編集
    Route::get('/edit/{id}', [EquipmentController::class, 'edit']);
    // 取得した備品IDで更新
    Route::post('/update/{id}', [EquipmentController::class, 'update']);
    // 備品IDで削除
    Route::post('/delete/{id}', [EquipmentController::class, 'destroy']);
    // 複数備品IDで削除
    Route::post('/deleteAll', [EquipmentController::class, 'deleteAll']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

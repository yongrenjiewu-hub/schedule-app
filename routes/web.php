<?php

use App\Http\Controllers\MdialysisController;
use App\Http\Controllers\TAssignedController;
use App\Http\Controllers\TPtscheduleController;
use App\Models\Mdialysis;
use App\Models\TAssigned;
use App\Models\TMedicalrecord;
use App\Models\TPtschedule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MPatientController;
use App\Http\Controllers\MMealController;
use App\Http\Controllers\MCarekindController;
use App\Http\Controllers\MTreatmentkindController;
use App\Http\Controllers\MDiseaseController;
use App\Http\Controllers\MMedicineController;
use App\Http\Controllers\MMypatientController;


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
Auth::routes();
//認証ユーザのみアクセル可能なグループに全てまとめる
Route::middleware('auth')->group(function () {
// 認証が必要なルートここにまとめる
Route::prefix('patient')->group(function () {
    // 「固定文字列」のルートを先に定義する！患者一覧画面もidを取れるようになっているため
    //患者登録画面
    Route::get('/register',[MPatientController::class,'register'])->name('patient.register');

    //患者登録
    Route::post('/register',[MPatientController::class,'store'])->name('patient.store');

    //患者一覧画面
    Route::get('/{id?}', [MPatientController::class, 'index'])->name('patient.index');
    
    //患者情報画面
    Route::get('/information/{pt_id}',[MPatientController::class,'information'])->name('patient.information');

    //患者情報登録画面
    Route::get('/information/{pt_id}/add',[MPatientController::class,'show'])->name('patient.add');
    Route::post('/information/{pt_id}/add',[MPatientController::class,'update'])->name('patient.update');
    
    //患者情報内カルテ登録
    Route::get('/information/documents', [MPatientController::class, 'information'])->name('document.information');
    Route::post('/information/documents', [MPatientController::class, 'extra'])->name('document.extra');

});

Route::prefix('assigned')->middleware('auth')->group(function () {
    //My患者一覧表示
    Route::get('/{id?}', [TAssignedController::class, 'index'])->name('assigned.index');

    //患者一覧からMy患者へ患者追加
    Route::post('/add/{pt_id}', [TAssignedController::class, 'add'])->name('assigned.add');

    //My患者一覧内の患者削除
    Route::delete('/remove/{pt_id}', [TAssignedController::class, 'remove'])->name('assigned.remove');
});

Route::prefix('assigned')->group(function () {
    //My患者一覧画面
    Route::get('/',[TAssignedController::class,'index'])->name('assigned.index');  
});

Route::prefix('schedule')->group(function () {
    //スケジュール画面
    Route::get('/{id?}',[TPtscheduleController::class,'index'])->name('schedule.index');

     // 削除ルート（TPtscheduleController にまとめる）
     Route::delete('/carekind/{id}', [TPtscheduleController::class, 'destroyCarekind'])->name('schedule.carekind.destroy');
     Route::delete('/treatmentkind/{id}', [TPtscheduleController::class, 'destroyTreatmentkind'])->name('schedule.treatmentkind.destroy');
     Route::delete('/dialysis/{id}', [TPtscheduleController::class, 'destroyDialysis'])->name('schedule.dialysis.destroy');
     Route::delete('/medicine/{id}', [TPtscheduleController::class, 'destroyMedicine'])->name('schedule.medicine.destroy');
     Route::delete('/meal/{id}', [TPtscheduleController::class, 'destroyMeal'])->name('schedule.meal.destroy');
});


Route::prefix('meal')->group(function () {
    //食事一覧
    Route::get('/{pt_id}',[MMealController::class,'index'])->name('meal.index');

    //食事登録画面
    Route::get('/register',[MMealController::class,'register'])->name('meal.register');

    //食事登録
    Route::post('/register',[MMealController::class,'store'])->name('meal.store');

    // 食事削除
    //Route::delete('/{id}', [MMealController::class, 'destroy'])->name('meal.destroy');
});


Route::prefix('carekind')->group(function () {
    //ケア一覧
    Route::get('/{pt_id}',[MCarekindController::class,'index'])->name('carekind.index');

    //ケア登録画面
    Route::get('/register',[MCarekindController::class,'register'])->name('carekind.register');

    //ケア登録
    Route::post('/register',[MCarekindController::class,'store'])->name('carekind.store');

    // ケア削除
    //Route::delete('/{id}', [MCarekindController::class, 'destroy'])->name('carekind.destroy');
});


Route::prefix('treatmentkind')->group(function () {
    //治療一覧
    Route::get('/{pt_id}',[MTreatmentkindController::class,'index'])->name('treatmentkind.index');

    //治療登録画面
    Route::get('/register',[MTreatmentkindController::class,'register'])->name('treatmentkind.register');

    //治療登録
    Route::post('/register',[MTreatmentkindController::class,'store'])->name('treatmentkind.store');  

    // 治療削除
    //Route::delete('/{id}', [MTreatmentkindController::class, 'destroy'])->name('treatmentkind.destroy');
});


Route::prefix('dialysis')->group(function () {
    //透析
    Route::get('/{pt_id}',[MdialysisController::class,'index'])->name('dialysis.index');

    //透析登録画面
    Route::get('/register',[MdialysisController::class,'register'])->name('dialysis.register');

    //透析登録
    Route::post('/register',[MdialysisController::class,'store'])->name('dialysis.store');

    // 透析削除
    //Route::delete('/{id}', [MDialysisController::class, 'destroy'])->name('dialysis.destroy');
});


Route::prefix('disease')->group(function () {
    //疾患
    Route::get('/',[MDiseaseController::class,'index'])->name('disease.index');

    //疾患登録画面
    Route::get('/register',[MDiseaseController::class,'register'])->name('disease.register');

    //疾患登録
    Route::post('/register',[MDiseaseController::class,'store'])->name('disease.store');
});


Route::prefix('medicine')->group(function () {
    //薬
    Route::get('/{pt_id}',[MMedicineController::class,'index'])->name('medicine.index');

    //薬登録画面
    Route::get('/register',[MMedicineController::class,'register'])->name('medicine.register');

    //薬登録
    Route::post('/register',[MMedicineController::class,'store'])->name('medicine.store');

    // 薬削除
    Route::delete('/{id}', [MMedicineController::class, 'destroy'])->name('medicine.delete');
});

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


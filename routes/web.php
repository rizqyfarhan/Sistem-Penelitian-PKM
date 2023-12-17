<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KemajuanPenelitianController;
use App\Http\Controllers\ArtikelJurnalController;
use App\Http\Controllers\HKIPenelitianController;
use App\Http\Controllers\ProposalPenelitianController;
use App\Http\Controllers\AkhirPenelitianController;
use App\Http\Controllers\KemajuanPKMController;

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

Route::get('/', function () {
    return view('penelitian.proposal-penelitian.upload-proposal-penelitian');
});

/******  PENELITIAN -> PROPOSAL **************/
Route::get('/upload-proposal-penelitian', function () {
    return view('penelitian.proposal-penelitian.upload-proposal-penelitian');
});
Route::get('/lihat-proposal-penelitian', function () {
    return view('penelitian.proposal-penelitian.lihat-proposal-penelitian');
});
// INDEX
Route::get('/lihat-proposal-penelitian', [ProposalPenelitianController::class, 'index']);
// ADD
Route::post('/upload-proposal-penelitian', [ProposalPenelitianController::class, 'store'])->name('proposalpenelitian.store');
// DELETE
Route::delete('/lihat-proposal-penelitian/{id}', [ProposalPenelitianController::class, 'delete'])->name('proposalpenelitian.delete');
/********************************************/

/******  PENELITIAN -> LAPORAN KEMAJUAN *****/
Route::get('/upload-kemajuan-penelitian', function () {
    return view('penelitian.laporan-kemajuan.upload-kemajuan-penelitian');
});
Route::get('/lihat-kemajuan-penelitian', function () {
    return view('penelitian.laporan-kemajuan.lihat-kemajuan-penelitian');
});

// INDEX
Route::get('/lihat-kemajuan-penelitian', [KemajuanPenelitianController::class, 'index']);
// ADD
Route::post('/laporan-kemajuan-penelitian', [KemajuanPenelitianController::class, 'store'])->name('lapkempenelitian.store');
// DELETE
Route::delete('/lihat-kemajuan-penelitian/{id}', [KemajuanPenelitianController::class, 'delete'])->name('lapkempenelitian.delete');
/********************************************/

/******  PENELITIAN -> LAPORAN AKHIR ********/
Route::get('/upload-lap-akhir-penelitian', function () {
    return view('penelitian.laporan-akhir.upload-lap-akhir-penelitian');
});
Route::get('/lihat-lap-akhir-penelitian', function () {
    return view('penelitian.laporan-akhir.lihat-lap-akhir-penelitian');
});

// INDEX
Route::get('/lihat-lap-akhir-penelitian', [AkhirPenelitianController::class, 'index']);
// ADD
Route::post('/upload-lap-akhir-penelitian', [AkhirPenelitianController::class, 'store'])->name('lapakhpenelitian.store');
// DELETE
Route::delete('/lihat-lap-akhir-penelitian/{id}', [AkhirPenelitianController::class, 'delete'])->name('lapakhpenelitian.delete');
/********************************************/

/******  PENELITIAN -> ARTIKEL JURNAL *******/
Route::get('/upload-jurnal-penelitian', function () {
    return view('penelitian.laporan-jurnal.upload-jurnal-penelitian');
});
Route::get('/lihat-jurnal-penelitian', function () {
    return view('penelitian.laporan-jurnal.lihat-jurnal-penelitian');
});

// INDEX
Route::get('/lihat-jurnal-penelitian', [ArtikelJurnalController::class, 'index']);
// ADD
Route::post('/upload-jurnal-penelitian', [ArtikelJurnalController::class, 'store'])->name('artikeljurnal.store');
// DELETE
Route::delete('/lihat-jurnal-penelitian/{id}', [ArtikelJurnalController::class, 'delete'])->name('artikeljurnal.delete');
/********************************************/

/******  PENELITIAN -> HKI *****************/
Route::get('/upload-HKI-penelitian', function () {
    return view('penelitian.HKI.upload-HKI-penelitian');
});
Route::get('/lihat-HKI-penelitian', function () {
    return view('penelitian.HKI.lihat-HKI-penelitian');
});
// INDEX
Route::get('/lihat-HKI-penelitian', [HKIPenelitianController::class, 'index']);
// ADD
Route::post('/upload-HKI-penelitian', [HKIPenelitianController::class, 'store'])->name('hkipenelitian.store');
// DELETE
Route::delete('/lihat-HKI-penelitian/{id}', [HKIPenelitianController::class, 'delete'])->name('hkipenelitian.delete');
/********************************************/

/******  PKM -> LAPORAN KEMAJUAN ************/
Route::get('/upload-lap-kemajuan-pkm', function () {
    return view('pkm.laporan-kemajuan.upload-lap-kemajuan-pkm');
});
Route::get('/lihat-lap-kemajuan-pkm', function () {
    return view('pkm.laporan-kemajuan.lihat-lap-kemajuan-pkm');
});
// INDEX
Route::get('/lihat-lap-kemajuan-pkm', [KemajuanPKMController::class, 'index']);
// ADD
Route::post('/upload-lap-kemajuan-pkm', [KemajuanPKMController::class, 'store'])->name('lapkempkm.store');
// DELETE
Route::delete('/lihat-lap-kemajuan-pkm/{id}', [KemajuanPKMController::class, 'delete'])->name('lapkempkm.delete');
/********************************************/

/******  PKM -> LAPORAN AKHIR ***************/
Route::get('/upload-lap-akhir-pkm', function () {
    return view('pkm.laporan-akhir.upload-lap-akhir-pkm');
});
Route::get('/lihat-lap-akhir-pkm', function () {
    return view('pkm.laporan-akhir.lihat-lap-akhir-pkm');
});
/********************************************/

/******  PKM -> LAPORAN JURNAL **************/
Route::get('/upload-lap-jurnal-pkm', function () {
    return view('pkm.laporan-jurnal.upload-lap-jurnal-pkm');
});
Route::get('/lihat-lap-jurnal-pkm', function () {
    return view('pkm.laporan-jurnal.lihat-lap-jurnal-pkm');
});
/********************************************/

/******  PKM -> LAPORAN MEDIA MASSA *********/
Route::get('/upload-media-massa', function () {
    return view('pkm.media-massa.upload-media-massa');
});
Route::get('/lihat-media-massa', function () {
    return view('pkm.media-massa.lihat-media-massa');
});
/********************************************/

/******  PKM -> HKI ************************/
Route::get('/upload-HKI-pkm', function () {
    return view('pkm.HKI.upload-HKI-pkm');
});
Route::get('/lihat-HKI-pkm', function () {
    return view('pkm.HKI.lihat-HKI-pkm');
});
/********************************************/

Route::get('/lihat-kemajuan-penelitian', [KemajuanPenelitianController::class, 'index']);

// ADD
Route::post('/laporan-kemajuan-penelitian', [KemajuanPenelitianController::class, 'store'])->name('lapkempenelitian.store');

// EDIT
Route::get('laporan-kemajuan-penelitian/{id}', function () {

});

// UPDATE
Route::put('laporan-kemajuan-penelitian/{id}', function () {

});

// DELETE
Route::delete('/lihat-kemajuan-penelitian/{id}', [KemajuanPenelitianController::class, 'delete'])->name('lapkempenelitian.delete');


Route::get('/login', function () {
    return view('login');
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KemajuanPenelitianController;
use App\Http\Controllers\ArtikelJurnalPenelitianController;
use App\Http\Controllers\HKIPenelitianController;
use App\Http\Controllers\ProposalPenelitianController;
use App\Http\Controllers\AkhirPenelitianController;
use App\Http\Controllers\KemajuanPKMController;
use App\Http\Controllers\AnggotaPenelitianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Reviewer\ReviewerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

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

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/logout', [LogoutController::class,'logout'])->name('logout');

Route::get('/', [DashboardController::class, 'show'])->name('dashboard');

Route::middleware(['auth', 'role:dosen'])->group(function() {

    Route::get('/penelitian', [IndexController::class, 'showPenelitian'])->name('penelitian');
    Route::get('/lihat-penelitian', [IndexController::class, 'indexPenelitian'])->name('show.penelitian');

    Route::get('/pkm', [HomeController::class, 'showPKM'])->name('pkm');
    
    Route::get('/download/{filename}', [ProposalPenelitianController::class, 'download'])->name('download.file');
    Route::get('/view/{filename}', [ProposalPenelitianController::class, 'view'])->name('view.file');
    Route::get('/edit/penelitian/{id}', [ProposalPenelitianController::class, 'edit'])->name('proposalpenelitian.edit');
    Route::put('/update/penelitian/{id}', [ProposalPenelitianController::class, 'update'])->name('proposalpenelitian.update');
    
    /******  PENELITIAN -> PROPOSAL **************/
    Route::post('/store/proposal/penelitian/', [IndexController::class, 'storeProposalPenelitian'])->name('store.proposalpenelitian');
    Route::get('/download/proposal/penelitian/{filename}', [IndexController::class, 'downloadProposalPenelitian'])->name('download.proposalpenelitian');
    Route::get('/view/proposal/penelitian/{filename}', [IndexController::class, 'viewProposalPenelitian'])->name('view.proposalpenelitian');
    Route::get('/edit/proposal/penelitian/{id}', [IndexController::class, 'editProposalPenelitian'])->name('edit.proposalpenelitian');
    Route::put('/update/proposal/penelitian/{id}', [IndexController::class, 'updateProposalPenelitian'])->name('update.proposalpenelitian');
    Route::delete('/delete/proposal/penelitian/{id}', [IndexController::class, 'deleteProposalPenelitian'])->name('delete.proposalpenelitian');

    /******  PENELITIAN -> KEMAJUAN **************/
    Route::post('/store/kemajuan/penelitian/', [IndexController::class, 'storeKemajuanPenelitian'])->name('store.kemajuanpenelitian');
    Route::get('/download/kemajuan/penelitian/{filename}', [IndexController::class, 'downloadKemajuanPenelitian'])->name('download.kemajuanpenelitian');
    Route::get('/view/kemajuan/penelitian/{filename}', [IndexController::class, 'viewKemajuanPenelitian'])->name('view.kemajuanpenelitian');
    Route::get('/edit/kemajuan/penelitian/{id}', [IndexController::class, 'editKemajuanPenelitian'])->name('edit.kemajuanpenelitian');
    Route::put('/update/kemajuan/penelitian/{id}', [IndexController::class, 'updateKemajuanPenelitian'])->name('update.kemajuanpenelitian');
    Route::delete('/delete/kemajuan/penelitian/{id}', [IndexController::class, 'deleteKemajuanPenelitian'])->name('delete.kemajuanpenelitian');
    
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
    // TAMBAH ANGGOTA PENELITI
    Route::get('/tambah-anggota', function() {
        return view('penelitian.proposal-penelitian.tambah-anggota');
    });
    Route::post('/tambah-anggota', [AnggotaPenelitianController::class, 'store'])->name('anggota.store');
    /********************************************/
    
    /******  PENELITIAN -> LAPORAN KEMAJUAN *****/
    Route::get('/upload-kemajuan-penelitian', function () {
        return view('penelitian.laporan-kemajuan.upload-kemajuan-penelitian');
    });
    Route::get('/lihat-kemajuan-penelitian', function () {
        return view('penelitian.laporan-kemajuan.lihat-kemajuan-penelitian');
    });
    
    // INDEX
    Route::get('/lihat-kemajuan-penelitian', [LaporanKemajuanPenelitianController::class, 'index']);
    // ADD
    Route::post('/laporan-kemajuan-penelitian', [LaporanKemajuanPenelitianController::class, 'store'])->name('lapkempenelitian.store');
    // DELETE
    Route::delete('/lihat-kemajuan-penelitian/{id}', [LaporanKemajuanPenelitianController::class, 'delete'])->name('lapkempenelitian.delete');
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
        return view('penelitian.artikel-jurnal.upload-jurnal-penelitian');
    });
    Route::get('/lihat-jurnal-penelitian', function () {
        return view('penelitian.artikel-jurnal.lihat-jurnal-penelitian');
    });
    
    // INDEX
    Route::get('/lihat-jurnal-penelitian', [ArtikelJurnalPenelitianController::class, 'index'])->name('artikeljurnal.index');
    // ADD
    Route::post('/upload-jurnal-penelitian', [ArtikelJurnalPenelitianController::class, 'store'])->name('artikeljurnal.store');
    // DELETE
    Route::delete('/lihat-jurnal-penelitian/{id}', [ArtikelJurnalPenelitianController::class, 'delete'])->name('artikeljurnal.delete');
    // DOWNLOAD
    Route::get('/download-jurnal-penelitian/{id}', [ArtikelJurnalPenelitianController::class, 'download'])->name('artikel-jurnal.download');
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
    
    /******  PKM -> PROPOSAL ********************/
    Route::get('/upload-proposal-pkm', function () {
        return view('pkm.proposal-pkm.upload-proposal-pkm');
    });
    Route::get('/lihat-proposal-pkm', function () {
        return view('pkm.proposal-pkm.lihat-proposal-pkm');
    });
    // INDEX
    Route::get('/lihat-proposal-pkm', [ProposalPKMController::class, 'index']);
    // ADD
    Route::post('/upload-proposal-pkm', [ProposalPKMController::class, 'store']);
    // DELETE
    Route::delete('/lihat-proposal-pkm/{id}', [ProposalPKMController::class, 'delete']);
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
});

Route::middleware(['auth', 'role:reviewer'])->group(function () {
    Route::get('/review-proposal-penelitian', [ProposalPenelitianController::class, 'showReviewerView'])->name('reviewer.penelitian');
    Route::get('/review-proposal-pkm', [ReviewerController::class, 'showProposalPKM']);
    Route::post('/update-status/{id}', [ProposalPenelitianController::class, 'updateStatus'])->name('proposalpenelitian.updateStatus');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'showAdmin'])->name('admin.upload'); 
    Route::post('/admin/upload-pengumuman', [DashboardController::class, 'uploadPengumuman'])->name('admin.uploadPengumuman');
    Route::post('/admin/upload-file', [DashboardController::class, 'uploadFile'])->name('admin.uploadFile');
});
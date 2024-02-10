<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaPenelitianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PKMController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPenelitianController;
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
Route::get('/download/{filename}', [DashboardController::class, 'downloadFile'])->name('download.file');

Route::middleware(['auth', 'role:dosen'])->group(function() {
    Route::get('/penelitian', [PenelitianController::class, 'showPenelitian'])->name('penelitian');
    Route::get('/lihat-penelitian', [PenelitianController::class, 'indexPenelitian'])->name('show.penelitian');

    Route::get('/pkm', [PKMController::class, 'showPKM'])->name('pkm');
    Route::get('/lihat-pkm', [PKMController::class, 'indexPKM'])->name('show.pkm');
    
    Route::get('/profile', [ProfileController::class, 'indexProfile'])->name('index.dosenprofile'); 

    /******  PENELITIAN -> PROPOSAL **************/
    Route::post('/store/proposal/penelitian/', [PenelitianController::class, 'storeProposalPenelitian'])->name('store.proposalpenelitian');
    Route::get('/download/proposal/penelitian/{filename}', [PenelitianController::class, 'downloadProposalPenelitian'])->name('download.proposalpenelitian');
    Route::get('/view/proposal/penelitian/{filename}', [PenelitianController::class, 'viewProposalPenelitian'])->name('view.proposalpenelitian');
    Route::get('/edit/proposal/penelitian/{id}', [PenelitianController::class, 'editProposalPenelitian'])->name('edit.proposalpenelitian');
    Route::put('/update/proposal/penelitian/{id}', [PenelitianController::class, 'updateProposalPenelitian'])->name('update.proposalpenelitian');
    Route::delete('/delete/proposal/penelitian/{id}', [PenelitianController::class, 'deleteProposalPenelitian'])->name('delete.proposalpenelitian');

    /******  ANGGOTA PENELITIAN **************/
    Route::get('/tambah-anggota', [AnggotaPenelitianController::class, 'showTambahAnggota'])->name('anggota.show');
    Route::post('/tambah-anggota', [AnggotaPenelitianController::class, 'store'])->name('anggota.store');
    Route::get('/lihat-anggota', [AnggotaPenelitianController::class, 'indexAnggota'])->name('anggota.index');
    Route::get('/edit/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'editAnggota'])->name('edit.anggota');
    Route::put('/update/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'updateAnggota'])->name('update.anggota');
    Route::delete('/delete/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'deleteAnggota'])->name('delete.anggota');

    /******  PENELITIAN -> KEMAJUAN **************/
    Route::post('/store/kemajuan/penelitian/', [PenelitianController::class, 'storeKemajuanPenelitian'])->name('store.kemajuanpenelitian');
    Route::get('/download/kemajuan/penelitian/{filename}', [PenelitianController::class, 'downloadKemajuanPenelitian'])->name('download.kemajuanpenelitian');
    Route::get('/view/kemajuan/penelitian/{filename}', [PenelitianController::class, 'viewKemajuanPenelitian'])->name('view.kemajuanpenelitian');
    Route::get('/edit/kemajuan/penelitian/{id}', [PenelitianController::class, 'editKemajuanPenelitian'])->name('edit.kemajuanpenelitian');
    Route::put('/update/kemajuan/penelitian/{id}', [PenelitianController::class, 'updateKemajuanPenelitian'])->name('update.kemajuanpenelitian');
    Route::delete('/delete/kemajuan/penelitian/{id}', [PenelitianController::class, 'deleteKemajuanPenelitian'])->name('delete.kemajuanpenelitian');
    
    /******  PENELITIAN -> AKHIR **************/
    Route::post('/store/akhir/penelitian/', [PenelitianController::class, 'storeAkhirPenelitian'])->name('store.akhirpenelitian');
    Route::get('/download/akhir/penelitian/{filename}', [PenelitianController::class, 'downloadAkhirPenelitian'])->name('download.akhirpenelitian');
    Route::get('/view/akhir/penelitian/{filename}', [PenelitianController::class, 'viewAkhirPenelitian'])->name('view.akhirpenelitian');
    Route::get('/edit/akhir/penelitian/{id}', [PenelitianController::class, 'editAkhirPenelitian'])->name('edit.akhirpenelitian');
    Route::put('/update/akhir/penelitian/{id}', [PenelitianController::class, 'updateAkhirPenelitian'])->name('update.akhirpenelitian');
    Route::delete('/delete/akhir/penelitian/{id}', [PenelitianController::class, 'deleteAkhirPenelitian'])->name('delete.akhirpenelitian');
    
    /******  PENELITIAN -> ARTIKEL JURNAL **************/
    Route::post('/store/artikel/penelitian/', [PenelitianController::class, 'storeArtikelJurnal'])->name('store.artikeljurnal');
    Route::get('/download/artikel/penelitian/{filename}', [PenelitianController::class, 'downloadArtikelJurnal'])->name('download.artikeljurnal');
    Route::get('/view/artikel/penelitian/{filename}', [PenelitianController::class, 'viewArtikelJurnal'])->name('view.artikeljurnal');
    Route::get('/edit/artikel/penelitian/{id}', [PenelitianController::class, 'editArtikelJurnal'])->name('edit.artikeljurnal');
    Route::put('/update/artikel/penelitian/{id}', [PenelitianController::class, 'updateArtikelJurnal'])->name('update.artikeljurnal');
    Route::delete('/delete/artikel/penelitian/{id}', [PenelitianController::class, 'deleteArtikelJurnal'])->name('delete.artikeljurnal');

    /******  PENELITIAN -> HKI **************/
    Route::post('/store/hki/penelitian/', [PenelitianController::class, 'storeHKIPenelitian'])->name('store.hkipenelitian');
    Route::get('/download/hki/penelitian/{filename}', [PenelitianController::class, 'downloadHKIPenelitian'])->name('download.hkipenelitian');
    Route::get('/view/hki/penelitian/{filename}', [PenelitianController::class, 'viewHKIPenelitian'])->name('view.hkipenelitian');
    Route::get('/edit/hki/penelitian/{id}', [PenelitianController::class, 'editHKIPenelitian'])->name('edit.hkipenelitian');
    Route::put('/update/hki/penelitian/{id}', [PenelitianController::class, 'updateHKIPenelitian'])->name('update.hkipenelitian');
    Route::delete('/delete/hki/penelitian/{id}', [PenelitianController::class, 'deleteHKIPenelitian'])->name('delete.hkipenelitian');

     /********** PKM *********************/

    /******  PKM -> PROPOSAL **************/
    Route::post('/store/proposal/pkm/', [PKMController::class, 'storeProposalPKM'])->name('store.proposalpkm');
    Route::get('/download/proposal/pkm/{filename}', [PKMController::class, 'downloadProposalPKM'])->name('download.proposalpkm');
    Route::get('/view/proposal/pkm/{filename}', [PKMController::class, 'viewProposalPKM'])->name('view.proposalpkm');
    Route::get('/edit/proposal/pkm/{id}', [PKMController::class, 'editProposalPKM'])->name('edit.proposalpkm');
    Route::put('/update/proposal/pkm/{id}', [PKMController::class, 'updateProposalPKM'])->name('update.proposalpkm');
    Route::delete('/delete/proposal/pkm/{id}', [PKMController::class, 'deleteProposalPKM'])->name('delete.proposalpkm');

    /******  PKM -> LAPORAN KEMAJUAN **************/
    Route::post('/store/kemajuan/pkm/', [PKMController::class, 'storeKemajuanPKM'])->name('store.kemajuanpkm');
    Route::get('/download/kemajuan/pkm/{filename}', [PKMController::class, 'downloadKemajuanPKM'])->name('download.kemajuanpkm');
    Route::get('/view/kemajuan/pkm/{filename}', [PKMController::class, 'viewKemajuanPKM'])->name('view.kemajuanpkm');
    Route::get('/edit/kemajuan/pkm/{id}', [PKMController::class, 'editKemajuanPKM'])->name('edit.kemajuanpkm');
    Route::put('/update/kemajuan/pkm/{id}', [PKMController::class, 'updateKemajuanPKM'])->name('update.kemajuanpkm');
    Route::delete('/delete/kemajuan/pkm/{id}', [PKMController::class, 'deleteKemajuanPKM'])->name('delete.kemajuanpkm');

    /******  PKM -> LAPORAN AKHIR **************/
    Route::post('/store/akhir/pkm/', [PKMController::class, 'storeAkhirPKM'])->name('store.akhirpkm');
    Route::get('/download/akhir/pkm/{filename}', [PKMController::class, 'downloadAkhirPKM'])->name('download.akhirpkm');
    Route::get('/view/akhir/pkm/{filename}', [PKMController::class, 'viewAkhirPKM'])->name('view.akhirpkm');
    Route::get('/edit/akhir/pkm/{id}', [PKMController::class, 'editAkhirPKM'])->name('edit.akhirpkm');
    Route::put('/update/akhir/pkm/{id}', [PKMController::class, 'updateAkhirPKM'])->name('update.akhirpkm');
    Route::delete('/delete/akhir/pkm/{id}', [PKMController::class, 'deleteAkhirPKM'])->name('delete.akhirpkm');

    /******  PKM -> HKI **************/
    Route::post('/store/hki/pkm/', [PKMController::class, 'storeHKIPKM'])->name('store.hkipkm');
    Route::get('/download/hki/pkm/{filename}', [PKMController::class, 'downloadHKIPKM'])->name('download.hkipkm');
    Route::get('/view/hki/pkm/{filename}', [PKMController::class, 'viewHKIPKM'])->name('view.hkipkm');
    Route::get('/edit/hki/pkm/{id}', [PKMController::class, 'editHKIPKM'])->name('edit.hkipkm');
    Route::put('/update/hki/pkm/{id}', [PKMController::class, 'updateHKIPKM'])->name('update.hkipkm');
    Route::delete('/delete/hki/pkm/{id}', [PKMController::class, 'deleteHKIPKM'])->name('delete.hkipkm');

    /******  PKM -> MEDIA MASSA **************/
    Route::post('/store/media/pkm/', [PKMController::class, 'storeMediaPKM'])->name('store.mediapkm');
    Route::get('/download/media/pkm/{filename}', [PKMController::class, 'downloadMediaPKM'])->name('download.mediapkm');
    Route::get('/view/media/pkm/{filename}', [PKMController::class, 'viewMediaPKM'])->name('view.mediapkm');
    Route::get('/edit/media/pkm/{id}', [PKMController::class, 'editMediaPKM'])->name('edit.mediapkm');
    Route::put('/update/media/pkm/{id}', [PKMController::class, 'updateMediaPKM'])->name('update.mediapkm');
    Route::delete('/delete/media/pkm/{id}', [PKMController::class, 'deleteMediaPKM'])->name('delete.mediapkm');

    /******  PKM -> JURNAL PKM **************/
    Route::post('/store/jurnal/pkm/', [PKMController::class, 'storeJurnalPKM'])->name('store.jurnalpkm');
    Route::get('/download/jurnal/pkm/{filename}', [PKMController::class, 'downloadJurnalPKM'])->name('download.jurnalpkm');
    Route::get('/view/jurnal/pkm/{filename}', [PKMController::class, 'viewJurnalPKM'])->name('view.jurnalpkm');
    Route::get('/edit/jurnal/pkm/{id}', [PKMController::class, 'editJurnalPKM'])->name('edit.jurnalpkm');
    Route::put('/update/jurnal/pkm/{id}', [PKMController::class, 'updateJurnalPKM'])->name('update.jurnalpkm');
    Route::delete('/delete/jurnal/pkm/{id}', [PKMController::class, 'deleteJurnalPKM'])->name('delete.jurnalpkm');
});

Route::middleware(['auth', 'role:reviewer'])->group(function () {
    Route::get('/reviewer/profile', [ProfileController::class, 'indexProfile'])->name('index.reviewerprofile');

    Route::get('/review-proposal-penelitian', [ReviewerController::class, 'showReviewerPenelitianIndex'])->name('review.penelitian');
    Route::get('/review-proposal-pkm', [ReviewerController::class, 'showReviewerPKMIndex'])->name('review.pkm');
    Route::post('/update-status/{id}', [ReviewerController::class, 'updateStatus'])->name('proposalpenelitian.updateStatus');
    Route::get('/reviewer/penelitian/download/{filename}', [ReviewerController::class, 'downloadReviewPenelitian'])->name('download.reviewPenelitian');
    Route::get('/reviewer/pkm/download/{filename}', [ReviewerController::class, 'downloadReviewPKM'])->name('download.reviewPKM');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'indexProfile'])->name('index.adminprofile');

    Route::get('/admin', [DashboardController::class, 'showAdmin'])->name('admin.upload'); 
    Route::post('/admin/upload-pengumuman', [DashboardController::class, 'uploadPengumuman'])->name('admin.uploadPengumuman');
    Route::post('/admin/upload-file', [DashboardController::class, 'uploadFile'])->name('admin.uploadFile');
    Route::delete('/delete/pengumuman/{id}', [DashboardController::class, 'deletePengumuman'])->name('delete.pengumuman');
    Route::delete('/delete/file/{id}', [DashboardController::class, 'deleteFile'])->name('delete.file');

    /******  PENELITIAN -> PROPOSAL **************/
    Route::post('/admin/store/proposal/', [AdminPenelitianController::class, 'storeProposalAdmin'])->name('store.proposaladmin');
    Route::get('/admin/download/proposal/{filename}', [AdminPenelitianController::class, 'downloadProposalAdmin'])->name('download.proposaladmin');
    Route::get('/admin/view/proposal/{filename}', [AdminPenelitianController::class, 'viewProposalAdmin'])->name('view.proposaladmin');
    Route::get('/admin/edit/proposal/{id}', [AdminPenelitianController::class, 'editProposalAdmin'])->name('edit.proposaladmin');
    Route::put('/admin/update/proposal/{id}', [AdminPenelitianController::class, 'updateProposalAdmin'])->name('update.proposaladmin');
    Route::delete('/admin/delete/proposal/{id}', [AdminPenelitianController::class, 'deleteProposalAdmin'])->name('delete.proposaladmin');
});
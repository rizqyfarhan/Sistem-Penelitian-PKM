<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaPenelitianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PKMController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPenelitianController;
use App\Http\Controllers\AdminPKMController;
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
    Route::post('/store/proposal/penelitian', [PenelitianController::class, 'storeProposalPenelitian'])->name('store.proposalpenelitian');
    Route::get('/download/proposal/penelitian/{filename}', [PenelitianController::class, 'downloadProposalPenelitian'])->name('download.proposalpenelitian');
    Route::get('/view/proposal/penelitian/{filename}', [PenelitianController::class, 'viewProposalPenelitian'])->name('view.proposalpenelitian');
    Route::get('/edit/proposal/penelitian/{nrk}', [PenelitianController::class, 'editProposalPenelitian'])->name('edit.proposalpenelitian');
    Route::put('/update/proposal/penelitian/{nrk}', [PenelitianController::class, 'updateProposalPenelitian'])->name('update.proposalpenelitian');
    Route::delete('/delete/proposal/penelitian/{nrk}', [PenelitianController::class, 'deleteProposalPenelitian'])->name('delete.proposalpenelitian');

    /******  ANGGOTA PENELITIAN **************/
    Route::get('/tambah-anggota', [AnggotaPenelitianController::class, 'showTambahAnggota'])->name('anggota.show');
    Route::post('/tambah-anggota', [AnggotaPenelitianController::class, 'store'])->name('anggota.store');
    Route::get('/lihat-anggota', [AnggotaPenelitianController::class, 'indexAnggota'])->name('anggota.index');
    Route::get('/edit/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'editAnggota'])->name('edit.anggota');
    Route::put('/update/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'updateAnggota'])->name('update.anggota');
    Route::delete('/delete/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'deleteAnggota'])->name('delete.anggota');

    /******  PENELITIAN -> KEMAJUAN **************/
    Route::post('/store/kemajuan/penelitian', [PenelitianController::class, 'storeKemajuanPenelitian'])->name('store.kemajuanpenelitian');
    Route::get('/download/kemajuan/penelitian/{filename}', [PenelitianController::class, 'downloadKemajuanPenelitian'])->name('download.kemajuanpenelitian');
    Route::get('/view/kemajuan/penelitian/{filename}', [PenelitianController::class, 'viewKemajuanPenelitian'])->name('view.kemajuanpenelitian');
    Route::get('/edit/kemajuan/penelitian/{nrk}', [PenelitianController::class, 'editKemajuanPenelitian'])->name('edit.kemajuanpenelitian');
    Route::put('/update/kemajuan/penelitian/{nrk}', [PenelitianController::class, 'updateKemajuanPenelitian'])->name('update.kemajuanpenelitian');
    Route::delete('/delete/kemajuan/penelitian/{nrk}', [PenelitianController::class, 'deleteKemajuanPenelitian'])->name('delete.kemajuanpenelitian');
    
    /******  PENELITIAN -> AKHIR **************/
    Route::post('/store/akhir/penelitian', [PenelitianController::class, 'storeAkhirPenelitian'])->name('store.akhirpenelitian');
    Route::get('/download/akhir/penelitian/{filename}', [PenelitianController::class, 'downloadAkhirPenelitian'])->name('download.akhirpenelitian');
    Route::get('/view/akhir/penelitian/{filename}', [PenelitianController::class, 'viewAkhirPenelitian'])->name('view.akhirpenelitian');
    Route::get('/edit/akhir/penelitian/{id}', [PenelitianController::class, 'editAkhirPenelitian'])->name('edit.akhirpenelitian');
    Route::put('/update/akhir/penelitian/{id}', [PenelitianController::class, 'updateAkhirPenelitian'])->name('update.akhirpenelitian');
    Route::delete('/delete/akhir/penelitian/{id}', [PenelitianController::class, 'deleteAkhirPenelitian'])->name('delete.akhirpenelitian');
    
    /******  PENELITIAN -> ARTIKEL JURNAL **************/
    Route::post('/store/artikel/penelitian', [PenelitianController::class, 'storeArtikelJurnal'])->name('store.artikeljurnal');
    Route::get('/download/artikel/penelitian/{filename}', [PenelitianController::class, 'downloadArtikelJurnal'])->name('download.artikeljurnal');
    Route::get('/view/artikel/penelitian/{filename}', [PenelitianController::class, 'viewArtikelJurnal'])->name('view.artikeljurnal');
    Route::get('/edit/artikel/penelitian/{id}', [PenelitianController::class, 'editArtikelJurnal'])->name('edit.artikeljurnal');
    Route::put('/update/artikel/penelitian/{id}', [PenelitianController::class, 'updateArtikelJurnal'])->name('update.artikeljurnal');
    Route::delete('/delete/artikel/penelitian/{id}', [PenelitianController::class, 'deleteArtikelJurnal'])->name('delete.artikeljurnal');

    /******  PENELITIAN -> HKI **************/
    Route::post('/store/hki/penelitian', [PenelitianController::class, 'storeHKIPenelitian'])->name('store.hkipenelitian');
    Route::get('/download/hki/penelitian/{filename}', [PenelitianController::class, 'downloadHKIPenelitian'])->name('download.hkipenelitian');
    Route::get('/view/hki/penelitian/{filename}', [PenelitianController::class, 'viewHKIPenelitian'])->name('view.hkipenelitian');
    Route::get('/edit/hki/penelitian/{id}', [PenelitianController::class, 'editHKIPenelitian'])->name('edit.hkipenelitian');
    Route::put('/update/hki/penelitian/{id}', [PenelitianController::class, 'updateHKIPenelitian'])->name('update.hkipenelitian');
    Route::delete('/delete/hki/penelitian/{id}', [PenelitianController::class, 'deleteHKIPenelitian'])->name('delete.hkipenelitian');

     /********** PKM *********************/

    /******  PKM -> PROPOSAL **************/
    Route::post('/store/proposal/pkm', [PKMController::class, 'storeProposalPKM'])->name('store.proposalpkm');
    Route::get('/download/proposal/pkm/{filename}', [PKMController::class, 'downloadProposalPKM'])->name('download.proposalpkm');
    Route::get('/view/proposal/pkm/{filename}', [PKMController::class, 'viewProposalPKM'])->name('view.proposalpkm');
    Route::get('/edit/proposal/pkm/{id}', [PKMController::class, 'editProposalPKM'])->name('edit.proposalpkm');
    Route::put('/update/proposal/pkm/{id}', [PKMController::class, 'updateProposalPKM'])->name('update.proposalpkm');
    Route::delete('/delete/proposal/pkm/{id}', [PKMController::class, 'deleteProposalPKM'])->name('delete.proposalpkm');

    /******  PKM -> LAPORAN KEMAJUAN **************/
    Route::post('/store/kemajuan/pkm', [PKMController::class, 'storeKemajuanPKM'])->name('store.kemajuanpkm');
    Route::get('/download/kemajuan/pkm/{filename}', [PKMController::class, 'downloadKemajuanPKM'])->name('download.kemajuanpkm');
    Route::get('/view/kemajuan/pkm/{filename}', [PKMController::class, 'viewKemajuanPKM'])->name('view.kemajuanpkm');
    Route::get('/edit/kemajuan/pkm/{id}', [PKMController::class, 'editKemajuanPKM'])->name('edit.kemajuanpkm');
    Route::put('/update/kemajuan/pkm/{id}', [PKMController::class, 'updateKemajuanPKM'])->name('update.kemajuanpkm');
    Route::delete('/delete/kemajuan/pkm/{id}', [PKMController::class, 'deleteKemajuanPKM'])->name('delete.kemajuanpkm');

    /******  PKM -> LAPORAN AKHIR **************/
    Route::post('/store/akhir/pkm', [PKMController::class, 'storeAkhirPKM'])->name('store.akhirpkm');
    Route::get('/download/akhir/pkm/{filename}', [PKMController::class, 'downloadAkhirPKM'])->name('download.akhirpkm');
    Route::get('/view/akhir/pkm/{filename}', [PKMController::class, 'viewAkhirPKM'])->name('view.akhirpkm');
    Route::get('/edit/akhir/pkm/{id}', [PKMController::class, 'editAkhirPKM'])->name('edit.akhirpkm');
    Route::put('/update/akhir/pkm/{id}', [PKMController::class, 'updateAkhirPKM'])->name('update.akhirpkm');
    Route::delete('/delete/akhir/pkm/{id}', [PKMController::class, 'deleteAkhirPKM'])->name('delete.akhirpkm');

    /******  PKM -> HKI **************/
    Route::post('/store/hki/pkm', [PKMController::class, 'storeHKIPKM'])->name('store.hkipkm');
    Route::get('/download/hki/pkm/{filename}', [PKMController::class, 'downloadHKIPKM'])->name('download.hkipkm');
    Route::get('/view/hki/pkm/{filename}', [PKMController::class, 'viewHKIPKM'])->name('view.hkipkm');
    Route::get('/edit/hki/pkm/{id}', [PKMController::class, 'editHKIPKM'])->name('edit.hkipkm');
    Route::put('/update/hki/pkm/{id}', [PKMController::class, 'updateHKIPKM'])->name('update.hkipkm');
    Route::delete('/delete/hki/pkm/{id}', [PKMController::class, 'deleteHKIPKM'])->name('delete.hkipkm');

    /******  PKM -> MEDIA MASSA **************/
    Route::post('/store/media/pkm', [PKMController::class, 'storeMediaPKM'])->name('store.mediapkm');
    Route::get('/download/media/pkm/{filename}', [PKMController::class, 'downloadMediaPKM'])->name('download.mediapkm');
    Route::get('/view/media/pkm/{filename}', [PKMController::class, 'viewMediaPKM'])->name('view.mediapkm');
    Route::get('/edit/media/pkm/{id}', [PKMController::class, 'editMediaPKM'])->name('edit.mediapkm');
    Route::put('/update/media/pkm/{id}', [PKMController::class, 'updateMediaPKM'])->name('update.mediapkm');
    Route::delete('/delete/media/pkm/{id}', [PKMController::class, 'deleteMediaPKM'])->name('delete.mediapkm');

    /******  PKM -> JURNAL PKM **************/
    Route::post('/store/jurnal/pkm', [PKMController::class, 'storeJurnalPKM'])->name('store.jurnalpkm');
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
    Route::post('/update-status/{nrk}', [ReviewerController::class, 'updateStatus'])->name('proposalpenelitian.updateStatus');
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

    Route::get('/admin/view/proposal', [AdminPenelitianController::class, 'indexProposalAdmin'])->name('index.proposaladmin');
    Route::get('/admin/upload/proposal', [AdminPenelitianController::class, 'showProposalAdmin'])->name('upload.proposaladmin');

    /******  (ADMIN) PENELITIAN -> PROPOSAL **************/
    Route::post('/admin/store/proposal', [AdminPenelitianController::class, 'storeProposalAdmin'])->name('store.proposaladmin');
    Route::get('/admin/download/proposal/{filename}', [AdminPenelitianController::class, 'downloadProposalAdmin'])->name('download.proposaladmin');
    Route::get('/admin/view/proposal/{filename}', [AdminPenelitianController::class, 'viewProposalAdmin'])->name('view.proposaladmin');
    Route::get('/admin/edit/proposal/{nrk}', [AdminPenelitianController::class, 'editProposalAdmin'])->name('edit.proposaladmin');
    Route::put('/admin/update/proposal/{nrk}', [AdminPenelitianController::class, 'updateProposalAdmin'])->name('update.proposaladmin');
    Route::delete('/admin/delete/proposal/{nrk}', [AdminPenelitianController::class, 'deleteProposalAdmin'])->name('delete.proposaladmin');

    /******  (ADMIN) ANGGOTA PENELITIAN **************/
    Route::get('/admin/tambah-anggota', [AnggotaPenelitianController::class, 'showTambahAnggota'])->name('anggota.showadmin');
    Route::post('/admin/tambah-anggota', [AnggotaPenelitianController::class, 'store'])->name('anggota.storeadmin');
    Route::get('/admin/lihat-anggota', [AnggotaPenelitianController::class, 'indexAnggota'])->name('anggota.indexadmin');
    Route::get('/admin/edit/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'editAnggota'])->name('edit.anggotaadmin');
    Route::put('/admin/update/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'updateAnggota'])->name('update.anggotaadmin');
    Route::delete('/admin/delete/anggota/penelitian/{id}', [AnggotaPenelitianController::class, 'deleteAnggota'])->name('delete.anggotaadmin');
    
    /******  (ADMIN) PENELITIAN -> KEMAJUAN **************/
    Route::post('/admin/store/kemajuan/penelitian', [AdminPenelitianController::class, 'storeKemajuanAdmin'])->name('store.kemajuanadmin');
    Route::get('/admin/download/kemajuan/penelitian/{filename}', [AdminPenelitianController::class, 'downloadKemajuanAdmin'])->name('download.kemajuanadmin');
    Route::get('/admin/view/kemajuan/penelitian/{filename}', [AdminPenelitianController::class, 'viewKemajuanAdmin'])->name('view.kemajuanadmin');
    Route::get('/admin/edit/kemajuan/penelitian/{id}', [AdminPenelitianController::class, 'editKemajuanAdmin'])->name('edit.kemajuanadmin');
    Route::put('/admin/update/kemajuan/penelitian/{id}', [AdminPenelitianController::class, 'updateKemajuanAdmin'])->name('update.kemajuanadmin');
    Route::delete('/admin/delete/kemajuan/penelitian/{id}', [AdminPenelitianController::class, 'deleteKemajuanAdmin'])->name('delete.kemajuanadmin');
    
    /******  (ADMIN) PENELITIAN -> AKHIR **************/
    Route::post('/admin/store/akhir/penelitian', [AdminPenelitianController::class, 'storeAkhirAdmin'])->name('store.akhiradmin');
    Route::get('/admin/download/akhir/penelitian/{filename}', [AdminPenelitianController::class, 'downloadAkhirAdmin'])->name('download.akhiradmin');
    Route::get('/admin/view/akhir/penelitian/{filename}', [AdminPenelitianController::class, 'viewAkhirAdmin'])->name('view.akhiradmin');
    Route::get('/admin/edit/akhir/penelitian/{id}', [AdminPenelitianController::class, 'editAkhirAdmin'])->name('edit.akhiradmin');
    Route::put('/admin/update/akhir/penelitian/{id}', [AdminPenelitianController::class, 'updateAkhirAdmin'])->name('update.akhiradmin');
    Route::delete('/admin/delete/akhir/penelitian/{id}', [AdminPenelitianController::class, 'deleteAkhirAdmin'])->name('delete.akhiradmin');

    /******  (ADMIN) PENELITIAN -> ARTIKEL JURNAL **************/
    Route::post('/admin/store/artikel/penelitian', [AdminPenelitianController::class, 'storeArtikelAdmin'])->name('store.artikeladmin');
    Route::get('/admin/download/artikel/penelitian/{filename}', [AdminPenelitianController::class, 'downloadArtikelAdmin'])->name('download.artikeladmin');
    Route::get('/admin/view/artikel/penelitian/{filename}', [AdminPenelitianController::class, 'viewArtikelAdmin'])->name('view.artikeladmin');
    Route::get('/admin/edit/artikel/penelitian/{id}', [AdminPenelitianController::class, 'editArtikelAdmin'])->name('edit.artikeladmin');
    Route::put('/admin/update/artikel/penelitian/{id}', [AdminPenelitianController::class, 'updateArtikelAdmin'])->name('update.artikeladmin');
    Route::delete('/admin/delete/artikel/penelitian/{id}', [AdminPenelitianController::class, 'deleteArtikelAdmin'])->name('delete.artikeladmin');

     /******  (ADMIN) PENELITIAN -> HKI **************/
    Route::post('/admin/store/hki/penelitian', [AdminPenelitianController::class, 'storeHKIAdmin'])->name('store.hkiadmin');
    Route::get('/admin/download/hki/penelitian/{filename}', [AdminPenelitianController::class, 'downloadHKIAdmin'])->name('download.hkiadmin');
    Route::get('/admin/view/hki/penelitian/{filename}', [AdminPenelitianController::class, 'viewHKIAdmin'])->name('view.hkiadmin');
    Route::get('/admin/edit/hki/penelitian/{id}', [AdminPenelitianController::class, 'editHKIAdmin'])->name('edit.hkiadmin');
    Route::put('/admin/update/hki/penelitian/{id}', [AdminPenelitianController::class, 'updateHKIAdmin'])->name('update.hkiadmin');
    Route::delete('/admin/delete/hki/penelitian/{id}', [AdminPenelitianController::class, 'deleteHKIAdmin'])->name('delete.hkiadmin');

    /***************************************/
    
    /****** (ADMIN)  PKM  *************************/
    Route::get('/admin/view/proposal-pkm/', [AdminPKMController::class, 'indexProposalPKMAdmin'])->name('index.proposalpkmadmin');
    Route::get('/admin/upload/proposal-pkm/', [AdminPKMController::class, 'showProposalPKMAdmin'])->name('upload.proposalpkmadmin');

    /****** (ADMIN)  PKM -> PROPOSAL **************/
    Route::post('/admin/store/proposal/pkm', [AdminPKMController::class, 'storeProposalPKMAdmin'])->name('store.proposalpkmadmin');
    Route::get('/admin/download/proposal/pkm/{filename}', [AdminPKMController::class, 'downloadProposalPKMAdmin'])->name('download.proposalpkmadmin');
    Route::get('/admin/view/proposal/pkm/{filename}', [AdminPKMController::class, 'viewProposalPKMAdmin'])->name('view.proposalpkmadmin');
    Route::get('/admin/edit/proposal/pkm/{id}', [AdminPKMController::class, 'editProposalPKMAdmin'])->name('edit.proposalpkmadmin');
    Route::put('/admin/update/proposal/pkm/{id}', [AdminPKMController::class, 'updateProposalPKMAdmin'])->name('update.proposalpkmadmin');
    Route::delete('/admin/delete/proposal/pkm/{id}', [AdminPKMController::class, 'deleteProposalPKMAdmin'])->name('delete.proposalpkmadmin');

    /****** (ADMIN) PKM -> LAPORAN KEMAJUAN **************/
    Route::post('/admin/store/kemajuan/pkm', [AdminPKMController::class, 'storeKemajuanPKMAdmin'])->name('store.kemajuanpkmadmin');
    Route::get('/admin/download/kemajuan/pkm/{filename}', [AdminPKMController::class, 'downloadKemajuanPKMAdmin'])->name('download.kemajuanpkmadmin');
    Route::get('/admin/view/kemajuan/pkm/{filename}', [AdminPKMController::class, 'viewKemajuanPKMAdmin'])->name('view.kemajuanpkmadmin');
    Route::get('/admin/edit/kemajuan/pkm/{id}', [AdminPKMController::class, 'editKemajuanPKMAdmin'])->name('edit.kemajuanpkmadmin');
    Route::put('/admin/update/kemajuan/pkm/{id}', [AdminPKMController::class, 'updateKemajuanPKMAdmin'])->name('update.kemajuanpkmadmin');
    Route::delete('/admin/delete/kemajuan/pkm/{id}', [AdminPKMController::class, 'deleteKemajuanPKMAdmin'])->name('delete.kemajuanpkmadmin');

    /****** (ADMIN) PKM -> LAPORAN AKHIR **************/
    Route::post('/admin/store/akhir/pkm', [AdminPKMController::class, 'storeAkhirPKMAdmin'])->name('store.akhirpkmadmin');
    Route::get('/admin/download/akhir/pkm/{filename}', [AdminPKMController::class, 'downloadAkhirPKMAdmin'])->name('download.akhirpkmadmin');
    Route::get('/admin/view/akhir/pkm/{filename}', [AdminPKMController::class, 'viewAkhirPKMAdmin'])->name('view.akhirpkmadmin');
    Route::get('/admin/edit/akhir/pkm/{id}', [AdminPKMController::class, 'editAkhirPKMAdmin'])->name('edit.akhirpkmadmin');
    Route::put('/admin/update/akhir/pkm/{id}', [AdminPKMController::class, 'updateAkhirPKMAdmin'])->name('update.akhirpkmadmin');
    Route::delete('/admin/delete/akhir/pkm/{id}', [AdminPKMController::class, 'deleteAkhirPKMAdmin'])->name('delete.akhirpkmadmin');    

    /****** (ADMIN) PKM -> HKI **************/
    Route::post('/admin/store/hki/pkm', [AdminPKMController::class, 'storeHKIPKMAdmin'])->name('store.hkipkmadmin');
    Route::get('/admin/download/hki/pkm/{filename}', [AdminPKMController::class, 'downloadHKIPKMAdmin'])->name('download.hkipkmadmin');
    Route::get('/admin/view/hki/pkm/{filename}', [AdminPKMController::class, 'viewHKIPKMAdmin'])->name('view.hkipkmadmin');
    Route::get('/admin/edit/hki/pkm/{id}', [AdminPKMController::class, 'editHKIPKMAdmin'])->name('edit.hkipkmadmin');
    Route::put('/admin/update/hki/pkm/{id}', [AdminPKMController::class, 'updateHKIPKMAdmin'])->name('update.hkipkmadmin');
    Route::delete('/admin/delete/hki/pkm/{id}', [AdminPKMController::class, 'deleteHKIPKMAdmin'])->name('delete.hkipkmadmin');

    /****** (ADMIN) PKM -> MEDIA MASSA **************/
    Route::post('/admin/store/media/pkm', [AdminPKMController::class, 'storeMediaPKMAdmin'])->name('store.mediapkmadmin');
    Route::get('/admin/download/media/pkm/{filename}', [AdminPKMController::class, 'downloadMediaPKMAdmin'])->name('download.mediapkmadmin');
    Route::get('/admin/view/media/pkm/{filename}', [AdminPKMController::class, 'viewMediaPKMAdmin'])->name('view.mediapkmadmin');
    Route::get('/admin/edit/media/pkm/{id}', [AdminPKMController::class, 'editMediaPKMAdmin'])->name('edit.mediapkmadmin');
    Route::put('/admin/update/media/pkm/{id}', [AdminPKMController::class, 'updateMediaPKMAdmin'])->name('update.mediapkmadmin');
    Route::delete('/admin/delete/media/pkm/{id}', [AdminPKMController::class, 'deleteMediaPKMAdmin'])->name('delete.mediapkmadmin');

    /****** (ADMIN) PKM -> JURNAL PKM **************/
    Route::post('/admin/store/jurnal/pkm', [AdminPKMController::class, 'storeJurnalPKMAdmin'])->name('store.jurnalpkmadmin');
    Route::get('/admin/download/jurnal/pkm/{filename}', [AdminPKMController::class, 'downloadJurnalPKMAdmin'])->name('download.jurnalpkmadmin');
    Route::get('/admin/view/jurnal/pkm/{filename}', [AdminPKMController::class, 'viewJurnalPKMAdmin'])->name('view.jurnalpkmadmin');
    Route::get('/admin/edit/jurnal/pkm/{id}', [AdminPKMController::class, 'editJurnalPKMAdmin'])->name('edit.jurnalpkmadmin');
    Route::put('/admin/update/jurnal/pkm/{id}', [AdminPKMController::class, 'updateJurnalPKMAdmin'])->name('update.jurnalpkmadmin');
    Route::delete('/admin/delete/jurnal/pkm/{id}', [AdminPKMController::class, 'deleteJurnalPKMAdmin'])->name('delete.jurnalpkmadmin');
});
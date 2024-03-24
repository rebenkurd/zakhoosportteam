<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FixtureController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PlayerController;
use App\Http\Controllers\Backend\ReklamController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SponsorController;
use App\Http\Controllers\Backend\TeamController;
use Illuminate\Support\Facades\Route;




Route::get('/fixture',[FixtureController::class,'allFixtures']);





Route::middleware(['auth'])->group(function() {

    // Dashboard Routes
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/','index')->name('dashboard');
        Route::get('/dashboard','index')->name('dashboard');
    });

    // User Routes
    Route::controller(UserController::class)->group(function() {
        Route::get('/list-of-users','ListOfUsers')->name('list.user');
        Route::get('/add-user','AddUser')->name('add.user');
        Route::post('/store-user','StoreUser')->name('store.user');
        Route::post('/delete-user/{id}','DeleteUser')->name('delete.user');
        Route::get('/edit-user/{id}','EditUser')->name('edit.user');
        Route::post('/update-user/{id}','UpdateUser')->name('update.user');
        Route::get('/detail-user/{id}','DetailUser')->name('detail.user');
        Route::get('/list-of-recycle-users','ListOfRecycleUser')->name('recycle.user');
        Route::post('/restore-user/{id}','RestoreUser')->name('restore.user');
        Route::post('/ban-user/{id}','BanUser')->name('ban.user');
        Route::get('/profile-user/{id}','ProfileUser')->name('profile.user');
        Route::get('/user-logout','logout')->name('logout.user');
        Route::post('/user-status/{id}','UserStatus')->name('user.status');
    });

    // Role Routes
    Route::controller(RoleController::class)->group(function() {
        Route::get('/list-of-roles','ListOfRoles')->name('list.role');
        Route::get('/add-role','AddRole')->name('add.role');
        Route::post('/store-role','StoreRole')->name('store.role');
        Route::post('/delete-role/{id}','DeleteRole')->name('delete.role');
        Route::get('/edit-role/{id}','EditRole')->name('edit.role');
        Route::post('/update-role/{id}','UpdateRole')->name('update.role');
        Route::get('/assign-permission-to-role/{id}','AssignPermissionToRole')->name('assign.permission');
        Route::post('/store-assign-permission-to-role/{id}','StoreAssignPermissionToRole')->name('store.assign.permission');
    });

    // Sponsor Routes
    Route::controller(SponsorController::class)->group(function() {
        Route::get('/list-of-sponsors','ListOfSponsors')->name('list.sponsor');
        Route::get('/add-sponsor','AddSponsor')->name('add.sponsor');
        Route::post('/store-sponsor','StoreSponsor')->name('store.sponsor');
        Route::post('/delete-sponsor/{id}','DeleteSponsor')->name('delete.sponsor');
        Route::get('/edit-sponsor/{id}','EditSponsor')->name('edit.sponsor');
        Route::post('/update-sponsor/{id}','UpdateSponsor')->name('update.sponsor');
        Route::post('/sponsor-status/{id}','SponsorStatus')->name('sponsor.status');
        Route::get('/list-of-recycle-sponsors','ListOfRecycleSponsor')->name('recycle.sponsor');
        Route::post('/restore-sponsor/{id}','RestoreSponsor')->name('restore.sponsor');
        Route::post('/ban-sponsor/{id}','BanSponsor')->name('ban.sponsor');
    });

    // Reklam Routes
    Route::prefix('reklam')->controller(ReklamController::class)->group(function() {
        Route::get('/list','ListOfReklams')->name('list.reklam');
        Route::get('/add','AddReklam')->name('add.reklam');
        Route::post('/store','StoreReklam')->name('store.reklam');
        Route::post('/delete/{id}','DeleteReklam')->name('delete.reklam');
        Route::get('/edit/{id}','EditReklam')->name('edit.reklam');
        Route::post('/update/{id}','UpdateReklam')->name('update.reklam');
        Route::post('/status/{id}','ReklamStatus')->name('reklam.status');
        Route::get('/recycle','ListOfRecycleReklam')->name('recycle.reklam');
        Route::post('/restore/{id}','RestoreReklam')->name('restore.reklam');
        Route::post('/ban/{id}','BanReklam')->name('ban.reklam');
    });

    // News Routes
    Route::prefix('news')->controller(NewsController::class)->group(function() {
        Route::get('/list','ListOfNews')->name('list.news');
        Route::get('/add','AddNews')->name('add.news');
        Route::post('/store','StoreNews')->name('store.news');
        Route::post('/delete/{id}','DeleteNews')->name('delete.news');
        Route::get('/edit/{id}','EditNews')->name('edit.news');
        Route::post('/update/{id}','UpdateNews')->name('update.news');
        Route::post('/status/{id}','NewsStatus')->name('news.status');
        Route::get('/recycle','ListOfRecycleNews')->name('recycle.news');
        Route::post('/restore/{id}','RestoreNews')->name('restore.news');
        Route::post('/ban/{id}','BanNews')->name('ban.news');
        Route::get('/detail/{id}','DetailNews')->name('detail.news');
    });

    // Player Routes
    Route::prefix('player')->controller(PlayerController::class)->group(function() {
        Route::get('/list','ListOfPlayer')->name('list.player');
        Route::get('/add','AddPlayer')->name('add.player');
        Route::post('/store','StorePlayer')->name('store.player');
        Route::post('/delete/{id}','DeletePlayer')->name('delete.player');
        Route::get('/edit/{id}','EditPlayer')->name('edit.player');
        Route::post('/update/{id}','UpdatePlayer')->name('update.player');
        Route::post('/status/{id}','PlayerStatus')->name('player.status');
        Route::get('/recycle','ListOfRecyclePlayer')->name('recycle.player');
        Route::post('/restore/{id}','RestorePlayer')->name('restore.player');
        Route::post('/ban/{id}','BanPlayer')->name('ban.player');
        Route::get('/detail/{id}','DetailPlayer')->name('detail.player');
    });

    // Team Routes
    Route::prefix('team')->controller(TeamController::class)->group(function() {
        Route::get('/detail','DetailTeam')->name('detail.team');
        Route::post('/update/{id}','UpdateTeam')->name('update.team');
    });


});












require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Auth\FacebookAuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FixtureController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PlayerController;
use App\Http\Controllers\Backend\PollCategoryController;
use App\Http\Controllers\Backend\ReklamController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SponsorController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\PollController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\PlayerStaffController;
use App\Http\Controllers\Frontend\VoteController;
use App\Http\Controllers\LocalizationController;
use App\Models\PollCategory;
use Illuminate\Support\Facades\Route;




Route::get('/fixture',[FixtureController::class,'allFixtures']);







Route::prefix('admin')->middleware(['auth','role:Super Admin.administrator,editor,author,contributor'])->group(function() {

    // Dashboard Routes
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/','index')->name('dashboard');
        Route::get('/dashboard','index')->name('dashboard');
    });

    // User Routes
    Route::prefix('user')->controller(UserController::class)->group(function() {
        Route::get('/list','ListOfUsers')->name('list.user');
        Route::get('/add','AddUser')->name('add.user');
        Route::post('/store','StoreUser')->name('store.user');
        Route::post('/delete/{id}','DeleteUser')->name('delete.user');
        Route::get('/edit/{id}','EditUser')->name('edit.user');
        Route::post('/update/{id}','UpdateUser')->name('update.user');
        Route::get('/detail/{id}','DetailUser')->name('detail.user');
        Route::get('/recycle','ListOfRecycleUser')->name('recycle.user');
        Route::post('/restore/{id}','RestoreUser')->name('restore.user');
        Route::post('/ban/{id}','BanUser')->name('ban.user');
        Route::get('/profile/{id}','ProfileUser')->name('profile.user');
        Route::post('/status/{id}','UserStatus')->name('user.status');

        Route::post('/delete-multiple','DeleteMultipleUser')->name('user.delete.multiple');
        Route::post('/ban-multiple','BanMultipleUser')->name('user.ban.multiple');
        Route::post('/restore-multiple','RestoreMultipleUser')->name('user.restore.multiple');

    });

    // Role Routes
    Route::prefix('role')->controller(RoleController::class)->group(function() {
        Route::get('/list','ListOfRoles')->name('list.role');
        Route::get('/add','AddRole')->name('add.role');
        Route::post('/store','StoreRole')->name('store.role');
        Route::post('/delete/{id}','DeleteRole')->name('delete.role');
        Route::get('/edit/{id}','EditRole')->name('edit.role');
        Route::post('/update/{id}','UpdateRole')->name('update.role');
        Route::get('/assign-permission/{id}','AssignPermissionToRole')->name('assign.permission');
        Route::post('/store-assign-permission/{id}','StoreAssignPermissionToRole')->name('store.assign.permission');

        Route::post('/delete-multiple','DeleteMultipleRole')->name('role.delete.multiple');
    });

    // Sponsor Routes
    Route::prefix('sponsor')->controller(SponsorController::class)->group(function() {
        Route::get('/list','ListOfSponsors')->name('list.sponsor');
        Route::get('/add','AddSponsor')->name('add.sponsor');
        Route::post('/store','StoreSponsor')->name('store.sponsor');
        Route::post('/delete/{id}','DeleteSponsor')->name('delete.sponsor');
        Route::get('/edit/{id}','EditSponsor')->name('edit.sponsor');
        Route::post('/update/{id}','UpdateSponsor')->name('update.sponsor');
        Route::post('/status/{id}','SponsorStatus')->name('sponsor.status');
        Route::get('/recycle','ListOfRecycleSponsor')->name('recycle.sponsor');
        Route::post('/restore/{id}','RestoreSponsor')->name('restore.sponsor');
        Route::post('/ban/{id}','BanSponsor')->name('ban.sponsor');

        Route::post('/delete-multiple','DeleteMultipleSponsor')->name('sponsor.delete.multiple');
        Route::post('/ban-multiple','BanMultipleSponsor')->name('sponsor.ban.multiple');
        Route::post('/restore-multiple','RestoreMultipleSponsor')->name('sponsor.restore.multiple');
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

        Route::post('/delete-multiple','DeleteMultipleReklam')->name('reklam.delete.multiple');
        Route::post('/ban-multiple','BanMultipleReklam')->name('reklam.ban.multiple');
        Route::post('/restore-multiple','RestoreMultipleReklam')->name('reklam.restore.multiple');
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

        Route::post('/delete-multiple','DeleteMultipleNews')->name('news.delete.multiple');
        Route::post('/ban-multiple','BanMultipleNews')->name('news.ban.multiple');
        Route::post('/restore-multiple','RestoreMultipleNews')->name('news.restore.multiple');
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

        Route::post('/delete-multiple','DeleteMultiplePlayer')->name('player.delete.multiple');
        Route::post('/ban-multiple','BanMultiplePlayer')->name('player.ban.multiple');
        Route::post('/restore-multiple','RestoreMultiplePlayer')->name('player.restore.multiple');
    });

    // Team Routes
    Route::prefix('team')->controller(TeamController::class)->group(function() {
        Route::get('/detail','DetailTeam')->name('detail.team');
        Route::post('/update/{id}','UpdateTeam')->name('update.team');
    });

    // Poll Routes
    Route::prefix('poll')->controller(PollController::class)->group(function() {
        Route::get('/list','ListOfPoll')->name('list.poll');
        Route::get('/add','AddPoll')->name('add.poll');
        Route::post('/store','StorePoll')->name('store.poll');
        Route::post('/delete/{id}','DeletePoll')->name('delete.poll');
        Route::get('/edit/{poll}','EditPoll')->name('edit.poll');
        Route::put('/update/{poll}','UpdatePoll')->name('update.poll');
        Route::post('/display/{id}','PollDisplay')->name('poll.display');
        Route::get('/recycle','ListOfRecyclePoll')->name('recycle.poll');
        Route::post('/restore/{id}','RestorePoll')->name('restore.poll');
        Route::post('/ban/{id}','BanPoll')->name('ban.poll');
        Route::get('/options/{id}','PollOptions')->name('poll.options');

        Route::post('/delete-multiple','DeleteMultiplePoll')->name('poll.delete.multiple');
        Route::post('/ban-multiple','BanMultiplePoll')->name('poll.ban.multiple');
        Route::post('/restore-multiple','RestoreMultiplePoll')->name('poll.restore.multiple');

    });

    // Poll Category Routes
    Route::prefix('poll/category')->controller(PollCategoryController::class)->group(function() {
        Route::get('/list','ListOfPollCategory')->name('list.poll.category');
        Route::get('/add','AddPollCategory')->name('add.poll.category');
        Route::post('/store','StorePollCategory')->name('store.poll.category');
        Route::post('/delete/{id}','DeletePollCategory')->name('delete.poll.category');
        Route::get('/edit/{id}','EditPollCategory')->name('edit.poll.category');
        Route::post('/update/{id}','UpdatePollCategory')->name('update.poll.category');
        Route::post('/status/{id}','PollCategoryStatus')->name('poll.category.status');
        Route::get('/recycle','ListOfRecyclePollCategory')->name('recycle.poll.category');
        Route::post('/restore/{id}','RestorePollCategory')->name('restore.poll.category');
        Route::post('/ban/{id}','BanPollCategory')->name('ban.poll.category');
        Route::get('/detail/{id}','DetailPollCategory')->name('detail.poll.category');

        Route::post('/delete-multiple','DeleteMultiplePollCategory')->name('poll.category.delete.multiple');
        Route::post('/ban-multiple','BanMultiplePollCategory')->name('poll.category.ban.multiple');
        Route::post('/restore-multiple','RestoreMultiplePollCategory')->name('poll.category.restore.multiple');
    });
});


Route::middleware(['auth'])->group(function() {

    // Set Localization
    Route::get('/lang/{locale}',[LocalizationController::class,'SetLang'])->name('set.lang');

    // user logout
    Route::get('/user-logout',[UserController::class,'logout'])->name('logout.user');

    // Home Page Routes
    Route::controller(HomeController::class)->group(function() {
        Route::get('/','HomePage')->name('home.page');
        Route::get('/home','HomePage')->name('home.page');
    });

    // Vote Page Routes
    Route::prefix('poll')->controller(VoteController::class)->group(function() {
        Route::get('/best-player/{poll}','VoteBestPlayerPage')->name('vote.player');
        Route::post('/vote-best-player/{poll}','StoreVote')->name('store.vote');
        Route::get('/best-goal/{poll}','VoteBestGoalPage')->name('vote.goal');
    });

    // News Page Routes
    Route::controller(FrontendNewsController::class)->group(function() {
        Route::get('/news','NewsPage')->name('news.page');
    });

    // Players And Staff Page Routes
    Route::controller(PlayerStaffController::class)->group(function() {
        Route::get('/player_staff','PlayerStaffPage')->name('player.staff.page');
    });


});



Route::get('/auth/google',[GoogleAuthController::class,'RedirectToGoogle'])->name('google.auth');
Route::get('/auth/google/call-back',[GoogleAuthController::class,'HandleGoogleCallback']);

Route::get('/auth/facebook',[FacebookAuthController::class,'RedirectToFacebook'])->name('facebook.auth');
Route::get('/auth/facebook/call-back',[FacebookAuthController::class,'HandleFacebookCallback']);









require __DIR__.'/auth.php';

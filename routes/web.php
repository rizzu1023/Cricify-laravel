<?php

use App\Http\Controllers\LiveScoreController;

//frontend Routes
Route::get('/index', [MainController::class,'GetIndex']);
Route::get('/pointsTable', [MainController::class,'GetPointsTable']);
Route::get('/teams', [MainController::class,'GetTeams']);
Route::get('/schedule', [MainController::class,'GetSchedule']);
Route::get('/stats', [MainController::class,'GetStats']);
Route::get('/',function(){
    return redirect()->route('admin.dashboard');
});
Route::view('/blank','Main.layouts.layout');

Auth::routes();

//Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class,'getDashboard'])->name('admin.dashboard');
    Route::resource('/Tournament','TournamentController');  //Tournament
    Route::post('/Tournament/addTeam',[TournamentController::class,'Tournament_add_Team'])->name('Tournament_add_Team');
    Route::post('/Tournament/destroyTeam',[TournamentController::class,'Tournament_destroy_Team'])->name('Tournament_destroy_Team');

    Route::resource('/feedbacks','FeedbackController');

    Route::get('/teams/{team}/players/exist_create',[TeamPlayerController::class,'exist_team_player_create']);
    Route::post('/teams/{team}/players/exist_store',[TeamPlayerController::class,'exist_team_player_store']);

    Route::resource('/PointsTable',\App\Http\Controllers\PointsTableController::class);  //PointsTable
    Route::resource('/Batting','BattingController');  //Batting
    Route::resource('/Bowling','BowlingController'); //Bowling

    Route::post('/Post_BrowseResult', [ResultController::class,'Post_BrowseResult'])->name('Post_BrowseResult');

    Route::get('/tournaments/{tournament}/results',[TournamentScheduleController::class,'results']);
    Route::get('/result/{tournament_id}/{match_id}/show', [ResultController::class,'result_show']);
    Route::delete('/result', [ResultController::class,'result_destroy'])->name('result.destroy');

    Route::post('/update-overs',[ResultController::class,'update_overs'])->name('update.overs');
    Route::post('/update-toss',[ResultController::class,'update_toss'])->name('update.toss');
    Route::post('/update-choose',[ResultController::class, 'update_choose'])->name('update.choose');
    Route::post('/update-player',[ResultController::class,'update_player'])->name('update.player');
    Route::post('/update-score',[ResultController::class,'update_score'])->name('update.score');


    Route::get('/LiveScore',[LiveScoreController::class,'LiveScoreindex'])->name('LiveScore.index');

    Route::get('/StartScore/{id}',[LiveScoreController::class,'StartScore'])->name('StartScore');
    Route::post('/ScoreDetails',[LiveScoreController::class,'ScoreDetails'])->name('ScoreDetails');

    Route::get('/LiveUpdate/{id}/{tournament}',[LiveScoreController::class,'LiveUpdateShow'])->name('LiveUpdate.show');
    Route::get('/LiveScoreCard/{id}/{tournament}',[LiveScoreController::class,'LiveScoreCard'])->name('LiveScoreCard');
    Route::post('/LiveUpdate',[LiveScoreController::class,'LiveUpdate'])->name('LiveUpdate')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::post('/LiveUpdate/mom',[LiveScoreController::class,'select_mom'])->name('select.mom');


    Route::resource('tournaments.schedules','TournamentScheduleController');
    Route::resource('tournaments.teams', 'TournamentTeamController');
    Route::resource('teams.players','TeamPlayerController');
    Route::get('/teams/{teamId}/players/excel/upload','TeamPlayerController@playerExcelUpload')->name('player.excel.upload');
    Route::post('/teams/{teamId}/players/excel/upload','TeamPlayerController@playerExcelUploadStore')->name('player.excel.upload.store');

    Route::resource('tournaments.groups','TournamentGroupController')->shallow();
    Route::resource('groups.teams','GroupTeamController');

    Route::get('tournaments/{tournament}/points-table',[\App\Http\Controllers\PointsTableController::class,'index']);
    Route::get('tournaments/{tournament}/points-table/edit',[App\Http\Controllers\PointsTableController::class,'edit']);

    Route::post('tournaments/{tournament}/points-table/match_selected',[PointsTableController::class,'match_selected']);
    Route::post('tournaments/{tournament}/points-table/nrr',[PointsTableController::class,'nrr']);



    Route::resource('player','PlayersController');
    Route::post('store-excel-player','PlayersController@storeExcelPlayer')->name('store.excel.player');

    Route::post('player/add-in-team',[PlayersController::class,'add_in_team']);
    Route::post('player/remove-from-team',[PlayersController::class,'remove_from_team']);




//    Route::resource('/teams','TeamController');

//    Route::post('/Team/filter','TeamController@teamFilter')->name('teamFilter');  //Team
//    Route::resource('/Players','PlayersController');    //Player
//    Route::post('/Players/filter','PlayersController@playerFilter')->name('playerFilter');
//    Route::resource('/Schedule','ScheduleController');  //Schedule
//    Route::post('/Schedule/create/tournament','ScheduleController@scheduleTournament')->name('scheduleTournament');

//    Route::get('/BrowseResult', 'ResultController@BrowseResult')->name('BrowseResult');


});



Route::group(['prefix' => 'super-admin', 'middleware' => ['auth']], function() {
    Route::get('user',[SuperAdminController::class,'user_index']);
    Route::get('admin',[SuperAdminController::class,'admin_index']);
});


Route::get('/home', [HomeController::class,'index'])->name('home');
//Route::get('/{any}', [App\Http\Controllers\AppController::class,'index'])->where('any','.*');

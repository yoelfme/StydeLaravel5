<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', [
    'as' => 'tickets.latest',
    'uses' => 'TicketsController@latest'
]);

Route::get('/populares', [
    'as' => 'tickets.popular',
    'uses' => 'TicketsController@popular'
]);

Route::get('/pendientes', [
    'as' => 'tickets.open',
    'uses' => 'TicketsController@open'
]);

Route::get('/tutoriales', [
    'as' => 'tickets.closed',
    'uses' => 'TicketsController@closed'
]);

Route::get('/solicitud/{id}', [
    'as' => 'tickets.detail',
    'uses' => 'TicketsController@detail'
]);

Route::post('/solicitud/{id}/seleccionar/{id_comment}', [
    'as' => 'tickets.select',
    'uses' => 'TicketsController@select'
]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function () {

    // Create a ticket
    Route::get('/solicitar', [
        'as' => 'tickets.create',
        'uses' => 'TicketsController@create'
    ]);
    Route::post('solicitar', [
        'as' => 'tickets.store',
        'uses' => 'TicketsController@store'
    ]);

    // Votes
    Route::post('votar/{id}', [
        'as' => 'votes.submit',
        'uses' => 'VotesController@submit'
    ]);
    Route::delete('votar/{id}', [
        'as' => 'votes.destroy',
        'uses' => 'VotesController@destroy'
    ]);

    // Comments
    Route::post('commentar/{id}', [
        'as' => 'comments.submit',
        'uses' => 'CommentsController@submit'
    ]);
});

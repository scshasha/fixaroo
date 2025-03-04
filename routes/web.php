<?php

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@administratorDashboard')->name('admin_dash');
Route::get('/dashboard', 'HomeController@agentDashboard')->name('agent_dash');

Auth::routes();


// Show Ticket Create Form
Route::get('ticket/create', 'TicketsController@create')->name('ticket_create');
// Store New Ticket
Route::post('ticket/create', 'TicketsController@store')->name('ticket_store');
// Store Comment
Route::post('comment', 'CommentsController@storeComment')->name('create comment');
// Show a Ticket
Route::get('tickets/{ticket_id}', 'TicketsController@show')->name('ticket_show');

Route::group(['middleware' => 'auth'], function () {
    Route::get('tickets', 'TicketsController@index');
    Route::get('tickets/assigned/{id}', 'TicketsController@getAgentTickets');
    Route::post('tickets/close/{ticket_id}', 'TicketsController@close')->name('close');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('tickets', 'TicketsController@index')->name('tickets');
    Route::post('tickets/close/{ticket_id}', 'TicketsController@close')->name('close');
    Route::get('tickets/edit/{ticket_id}', 'TicketsController@edit')->name('edit');
    Route::post('tickets/update', 'TicketsController@update')->name('update');
    Route::post('tickets/remove/{ticket_id}', 'TicketsController@destroy')->name('destroy');
});

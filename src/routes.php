<?php

/* Public Routes */

Route::group(['prefix' => 'pi/tickets', 'middleware'=>'web'], function($router){
	$router->get('/', '\PureIntellect\Tickets\Controllers\TicketController@index');
	$router->get('/users', function(){
    return \App\User::all();
	});

	$router->get('/create', 'PureIntellect\Tickets\Controllers\TicketController@create');
	$router->post('/create', 'PureIntellect\Tickets\Controllers\TicketController@store');

	$router->get('/{ticket_id}', 'PureIntellect\Tickets\Controllers\TicketController@show');
	$router->get('/{ticket_id}/edit', 'PureIntellect\Tickets\Controllers\TicketController@edit');
	$router->post('/{ticket_id}/edit', 'PureIntellect\Tickets\Controllers\TicketController@update');

	$router->post('/comment', 'PureIntellect\Tickets\Controllers\TicketCommentsController@postComment');
});

/* Staff Routes */
Route::group(['prefix' => 'pi/tickets', 'middleware'=>['web','dev']], function($router) {
	$router->get('/', 'PureIntellect\Tickets\Controllers\TicketController@index');
	$router->post('/close_ticket/{ticket_id}', 'PureIntellect\Tickets\Controllers\TicketController@close');
});

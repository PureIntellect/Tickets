<?php

/* Public Routes */

Route::group(['prefix' => 'tickets','middleware'=>'auth'], function($router){
	$router->get('/', 'PureIntellect\Tickets\Controllers\TicketController@index');
	
	$router->get('create', 'TicketController@create');
	$router->post('create', 'TicketController@store');
	
	$router->get('/{ticket_id}', 'TicketController@show');
	$router->get('/{ticket_id}/edit', 'TicketController@edit');
	$router->post('/{ticket_id}/edit', 'TicketController@update');
	
	$router->post('comment', 'TicketCommentsController@postComment');
});

/* Staff Routes */

Route::group(['prefix' => 'admin'], function($router) {
	$router->get('tickets', 'PureIntellect\Tickets\Controllers\TicketController@index');
	$router->post('close_ticket/{ticket_id}', 'PureIntellect\Tickets\Controllers\TicketController@close');
});

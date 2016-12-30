<?php

/* Public Routes */

Route::group(['prefix' => 'pi/tickets', 'middleware'=>['web','dev']], function($router){
	$router->get('/get/{type}', '\PureIntellect\Tickets\Controllers\TicketController@get');

	$router->get('/tickets', '\PureIntellect\Tickets\Controllers\TicketController@all');
	$router->post('/tickets', '\PureIntellect\Tickets\Controllers\TicketController@store');
	$router->put('/tickets/{ticket_id}', '\PureIntellect\Tickets\Controllers\TicketController@update');
	$router->delete('/tickets/{ticket_id}', '\PureIntellect\Tickets\Controllers\TicketController@destroy');

	$router->get('/comments', '\PureIntellect\Tickets\Controllers\TicketCommentController@all');
	$router->post('/comments', '\PureIntellect\Tickets\Controllers\TicketCommentController@store');
	$router->put('/comments/{ticket_id}', '\PureIntellect\Tickets\Controllers\TicketCommentController@update');
	$router->delete('/comments/{ticket_id}', '\PureIntellect\Tickets\Controllers\TicketCommentController@destroy');
});

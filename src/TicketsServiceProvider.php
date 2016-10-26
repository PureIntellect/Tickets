<?php
namespace PureIntellect\Tickets;

use Illuminate\Support\ServiceProvider;

class TicketsServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 * 
	 * @return void
	 */
	 public function boot(){
	 	require __DIR__ . '/../vendor/autoload.php';
	 	$this->loadViewsFrom(__DIR__.'/resources/views', 'tickets');
	 	$this->loadViewsFrom(__DIR__.'/resources/views', 'tickets');
	 }
	 
	 /**
	  *  Register the application services
	  * 
	  * @return void
	  */
	  public function register(){
		include __DIR__.'/routes.php';
		$this->app->make('PureIntellect\Tickets\Controllers\TicketController');
	  }
}

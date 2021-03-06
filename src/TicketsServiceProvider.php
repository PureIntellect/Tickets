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
	 	require __DIR__ . '/../../../autoload.php';

	 	$this->loadViewsFrom(__DIR__.'/../resources/views', 'Tickets');
		$this->mergeConfigFrom(__DIR__.'/../config/tickets.php', 'Tickets');
		$this->publishes([
			__DIR__.'/../config/tickets.php' => config_path('tickets.php'),
			__DIR__.'/../resources/assets/js/' => base_path('resources/assets/js/components/'),
			__DIR__ . '/../resources/views/' => base_path('resources/views/vendor/PureIntellect/Tickets/'),
			__DIR__.'/../resources/migrations/' => database_path('migrations')]);
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

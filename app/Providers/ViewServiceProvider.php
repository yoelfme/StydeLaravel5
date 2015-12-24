<?php
namespace TeachMe\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;

class ViewServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer(
			'tickets/list',
			function ($view) {
				$view->title = trans(Route::currentRouteName() . '_title');
				$view->total = Lang::choice(
					'tickets.total',
					$view->tickets->total(),
					['title' => strtolower($view->title)]);
			}
		);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
		/**
		 * Register services.
		 *
		 * This method is used to register bindings into the service container.
		 * Any class or functionality you need to register for dependency injection
		 * or application configuration should be done here.
		 *
		 * @return void
		 */
		public function register()
		{
				parent::register();
				
				// Bind the 'theme' service to the active theme configuration value
				$this->app->bind('theme', function () {
					return config('themes.active'); // Get the active theme from the configuration file
				});
		}
		
		/**
		 * Bootstrap services.
		 *
		 * This method is used to perform any actions needed for the application
		 * when all services have been registered. It is typically used to
		 * configure services, register view namespaces, or perform setup tasks.
		 *
		 * @return void
		 */
		public function boot()
		{
				// Dynamically add the active theme's view namespace based on the configuration
				// This makes the views for the active theme accessible as 'theme.*' in the application
				View::addNamespace('themes', resource_path('views/themes'));
		}
}
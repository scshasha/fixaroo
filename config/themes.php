<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Theme Configurations
	|--------------------------------------------------------------------------
	|
	| This configuration file is used to manage the active and available themes
	| for the Laravel application. It provides a simple way to manage themes
	| dynamically, allowing you to easily switch themes or add new ones in the
	| future. The active theme is the theme that the application uses to render
	| the front-end views, while available themes are the list of themes that
	| you can choose from.
	|
	| Usage:
	|
	| $activeTheme = config('themes.active');  // Get the currently active theme
	| $availableThemes = config('themes.available');  // Get the list of available themes
	|
	| Example for dynamically using themes in views:
	|
	| return view('themes.' . config('themes.active') . '.home');  // Load the 'home' view for the active theme
	|
	| Example for dynamically using assets:
	|
	| <link rel="stylesheet" href="{{ asset('themes/' . config('themes.active') . '/css/app.css') }}">
	|
	*/
	
	// The 'active' key defines the currently active theme for the application.
	// It is set via the environment file ('.env') to allow easy switching between themes.
	// If not specified in the '.env' file, it defaults to 'default'.
	'active' => env('ACTIVE_THEME', 'default'),
	
	// The 'available' key holds an array of all themes available in your application.
	// This allows you to have a predefined list of themes that can be switched between.
	// You can easily add new themes to this array as your theme list grows.
	'available' => ['default', 'new-theme', 'dark-theme'],

];
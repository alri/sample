<?php

namespace Alri\Sample;

use Illuminate\Support\ServiceProvider;

class SampleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

      //############################## Loading Part of Package
      //############################## Loading Part of Package

      //-- load Route
     	$this->loadRoutesFrom(__DIR__.'/web-route.php');
        $this->loadRoutesFrom(__DIR__.'/api-route.php');

	    //-- load View
	    $this->loadViewsFrom(__DIR__.'/Resources/Views', 'Alri\Sample');

        //-- load migration
        $this->loadMigrationsFrom(__DIR__.'/Migrations');



      //############################## Publish Part for send Values to APP
      //############################## Publish Part for send Values to APP

	    //------ publish Views
	    $this->publishes([
       		 __DIR__.'/Resources/Views/front' => resource_path('views/vendor/alri/sample'),
        ],'view');

      //----- publish Configs
       $this->publishes([
            __DIR__.'/Config/package.php' => config_path('alri.sample.package.php'),
       ],'config');

        //-- publish asset
        $this->publishes([
             __DIR__.'/Resources/assets' => public_path('vendor/alri/sample'),
         ], 'public');

    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //--- set config files :param1 =path & param2 :name
        $this->mergeConfigFrom(
            __DIR__.'/Config/package.php', 'SamplePackage'
          );

        //--- bind libe class for using in Facades
        $this->app->bind('Dog', 'Alri\Sample\Lib\Dog' );
    }
}

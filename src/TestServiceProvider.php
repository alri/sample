<?php

namespace Alri\Test;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
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
	         $this->loadViewsFrom(__DIR__.'/Resources/Views', 'Alri\Test');

           //-- load migration
           $this->loadMigrationsFrom(__DIR__.'/Migrations');



   //############################## Publish Part for send Values to APP
   //############################## Publish Part for send Values to APP

	    //------ publish Views
	    $this->publishes([
       		 __DIR__.'/Resources/Views' => resource_path('views/vendor/alri/test'),
    		]);

      //----- publish Configs
       $this->publishes([
            __DIR__.'/Config/package.php' => config_path('alri.test.package.php'),
        ]);

        //-- publish asset
        $this->publishes([
             __DIR__.'/Resources/assets' => public_path('vendor/alri/test'),
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
            __DIR__.'/Config/package.php', 'TestPackage'
          );

        //--- bind libe class for using in Facades
        $this->app->bind('Dog', 'Alri\Test\Lib\Dog' );
    }
}

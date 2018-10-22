<?php

//------------------------------
//---------- Web Routes
//-------------------------------
Route::prefix('package/test')->middleware(['web'])->group(function() {

//--- test config
	Route::get('/',function(){
			$name=config('TestPackage.name');
			return('Package Name Is : '.$name.'<br>'.'And Its Work Fine !!!');
		});

		//----- test view
		Route::get('/view',function(){
			return view("Alri\Test::back.index");
		});

		//------ controller check
		Route::get('/controller','Alri\Test\Controllers\HomeController@index');

		//------ model check
		Route::get('/model','Alri\Test\Controllers\HomeController@dbCheck');

	//------- middleware check
	Route::get('/middleware',function(){
	 	echo("This Message Shuld Not To Show !!!");
	})->middleware('CheckTest');


	//------- test Facade
	Route::get('/fasade',function(){
			Dog::woof();
		});

});


//------------------------------
//---------- Test Routes
//-------------------------------
Route::prefix('package/test/test')->middleware(['web'])->group(function() {

		Route::get('/','Alri\Test\Controllers\Tests\TestController@index');
		Route::get('/show','Alri\Test\Controllers\Tests\TestController@show');

 });

<?php

//------------------------------
//---------- Web Routes
//-------------------------------
Route::prefix('package/sample')->middleware(['web'])->group(function() {

//--- test config
	Route::get('/info',function(){
		$name=config('SamplePackage.name');
		$sub=(config('SamplePackage.subpackages'));
		echo('Package Name Is : '.$name.'<br><br>');
		echo('Sub Packages : '."<br>");
		foreach($sub as $item)
		{
			echo($item."<br>");
		}
	});

		//----- test view
		Route::get('/view',function(){
			return view("Alri\Sample::back.index");
		});

		//------ controller check
		Route::get('/controller','Alri\Sample\Controllers\HomeController@index');

		//------ model check
		Route::get('/model','Alri\Sample\Controllers\HomeController@dbCheck');

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

		Route::get('/','Alri\Sample\Controllers\Tests\TestController@index');
		Route::get('/show','Alri\Sample\Controllers\Tests\TestController@show');

 });


//------------------------------
//---------- Front Routes
//-------------------------------
Route::prefix('front/sample')->middleware(['web'])->group(function() {

});
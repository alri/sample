<?php
namespace Alri\Sample\Facades ;

use Illuminate\Support\Facades\Facade;

class Example extends Facade {
    protected static function getFacadeAccessor()
     {
        return 'Example';
      }
}

//use in controller :

//use Alri\Sample\Facades\Example;
//Example::dd();

//we can use alias for facade and use anywhere without use statment
/*
'aliases' => [
  ...
  'Example' => Alri\Sample\Facades\Example::class,
]

and use anywhere
Example::dd();
  */
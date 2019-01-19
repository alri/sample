# Welcome to Sample Package !

# About
**this package is Laravel 5.* Package and Developed By Alireza Abbyari : Alri .**

# Require
vendor/package-name

# Install
for install and work with this Laravel Package Follw this Step:

**0** install package with composer
```
composer require alri/controlpanel
```
OR
Install via composer with version - edit your composer.json to require the package.
```
"require": {
    "alri/sample": "1.*"
}
```
Then run composer update in your terminal


**1**
 add service provider to **config/app.php**

```
Alri\Sample\SampleServiceProvider::class,
```

**2**
if we have facade in package add this to aliases in **config/app.php**

```
'Dog'=> Alri\Sample\Facades\Dog::class,
```


**3**
Add **Middleware** to **kernel.php** in app/Http/Kernel.php

```
protected $routeMiddleware = [
'CheckTest'=>\Alri\Sample\Middlewares\CheckTest::class,
];
```

**4**
Run Migration for DB Setup :

```
  php artisan migrate
```



**5**
Pulish Public Asset & View

```
php artisan vendor:publish --tag=public --force
php artisan vendor:publish --tag=view --force
php artisan vendor:publish --tag=config --force
```

or publish with spesific package

```
php artisan vendor:publish --provider="Alri\Sample\SampleServiceProvider" --tag=view --force
```


**6**
[*optional*] Run Seeder with class name

```
php artisan db:seed --class=Alri\\Sample\\Seeds\\AlriSamplePackageTableSeeder
```


# Finish




# For Local Development

**1**
create **package** folder in **laravel app root** and clone the package in **package** folder in laravel application
add NameSpace and src to composer.json for local dev
```
"psr-4": {
        "App\\": "app/",
  "Alri\\Sample\\":"packages/alri/sample/src/"
    }
```


**2**
 for begining autoloading run :


    composer dump-autoload -o

**3**
add serviceprovider to provider in config/app.php

```
   /*
    * Package Service Providers...
    */
Alri\Sample\SampleServiceProvider::class,
```
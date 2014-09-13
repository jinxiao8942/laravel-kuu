<?php
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name or HTTP host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$env = $app->detectEnvironment(function () {
    if (file_exists(__DIR__ . '/../.env_name.php')) {
        return include(__DIR__ . '/../.env_name.php');
    } else {
        return 'development';
    }
});

/*
|--------------------------------------------------------------------------
| Bind Paths
|--------------------------------------------------------------------------
|
| Here we are binding the paths configured in paths.php to the app. You
| should not be changing these here. If you need to change these you
| may do so within the paths.php file and they will be bound here.
|
*/

$app->bindInstallPaths(require __DIR__.'/paths.php');

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load the Illuminate application. We'll keep this is in a
| separate location so we can isolate the creation of an application
| from the actual running of the application with a given request.
|
*/

$framework = __DIR__.'/../vendor/laravel/framework/src';

require $framework.'/Illuminate/Foundation/start.php';

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

Basset::collection('admin', function($collection)
{
    $collection->add('./assets/bootstrap/css/bootstrap.min.css')->apply('UriRewriteFilter')->setArguments(public_path());
    $collection->add('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
});

Basset::collection('login', function($collection)
{
    $collection->add('./assets/css/style.css');
    $collection->add('./assets/css/style_responsive.css');
    $collection->add('./assets/css/style_default.css');
    $collection->add('./assets/uniform/css/uniform.default.css');
})->apply('UriRewriteFilter')->setArguments(public_path())->andApply('CssMin');

Basset::collection('login_js', function($collection)
{
    $collection->add('./assets/js/jquery.min.js');
    $collection->add('./assets/bootstrap/js/bootstrap.min.js');
    $collection->add('./assets/uniform/jquery.uniform.min.js');
    $collection->add('./assets/js/jquery.blockui.js');
    $collection->add('./assets/js/app.js');
})->apply('JsMin');

Basset::collection('bootstrap', function($collection)
{
    $collection->add('./assets/bootstrap/css/bootstrap.min.css');
    $collection->add('./assets/css/metro.css');
    $collection->add('./assets/font-awesome/css/font-awesome.css');
    $collection->add('./assets/bootstrap/css/bootstrap-responsive.min.css');

})->apply('UriRewriteFilter')->setArguments(public_path())->andApply('CssMin');

Basset::collection('bootstrap_js', function($collection)
{
    $collection->add('./assets/js/jquery.min.js');
    $collection->add('./assets/bootstrap/js/bootstrap.min.js');
})->apply('JsMin');

Basset::collection('dashboard', function($collection)
{
    $collection->add('./assets/css/style.css');
    $collection->add('./assets/css/style_responsive.css');
    $collection->add('./assets/css/style_default.css');
})->apply('UriRewriteFilter')->setArguments(public_path())->andApply('CssMin');

Basset::collection('dashboard_js', function($collection)
{
    $collection->add('./assets/js/highcharts.js');
    $collection->add('./js/jquery.input-ip-address-control-1.0.min.js');
    $collection->add('./assets/js/main.js');
    $collection->add('./assets/js/add_another_site.js');
    $collection->add('./assets/js/site_more_info.js');


})->apply('JsMin');

Basset::collection('walkthrough', function($collection)
{
    $collection->add('./assets/css/dashboard.pagewalkthrough.css');
})->apply('UriRewriteFilter')->setArguments(public_path())->andApply('CssMin');

Basset::collection('walkthrough_js', function($collection)
{
    $collection->add('./assets/js/jquery.pagewalkthrough-1.1.0.js');
    $collection->add('./assets/js/settings.pagewalkthrough.js');
})->apply('JsMin');

Basset::collection('jquery_main_js', function($collection)
{
    $collection->add('./assets/js/jquery.min.js');
    $collection->add('./assets/js/main.js');
})->apply('JsMin');

Basset::collection('account_js', function($collection)
{
    $collection->add('./assets/js/account.js');
})->apply('JsMin');



return $app;

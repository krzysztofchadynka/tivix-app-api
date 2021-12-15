<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OMDBController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

$route = app(Router::class);

$route->group(['middleware' => 'auth:sanctum'], static function (Router $route) {
    Route::prefix('user')->group(function () use ($route) {
        $route->get('/data', [UserController::class, 'getUserData'])
            ->name('tivix.user.get_data');
        $route->post('/logout', [AuthController::class, 'logout'])
            ->name('tivix.user.logout');
    });

    Route::prefix('omdb')->group(function () use ($route) {
        $route->get('/movies/{title}/{year?}', [OMDBController::class, 'getMovies'])
            ->name('tivix.omdb.get_movies');

        $route->get('/episodes/{title}/{year?}', [OMDBController::class, 'getEpisodes'])
            ->name('tivix.omdb.get_episodes');

        $route->get('/series/{title}/{year?}', [OMDBController::class, 'getSeries'])
            ->name('tivix.omdb.get_series');
    });
});

Route::prefix('user')->group(function () use ($route) {
    $route->post('/register', [RegisterController::class, 'register'])
        ->name('tivix.user.register');
    $route->post('/login', [AuthController::class, 'login'])
        ->name('tivix.user.login');
});

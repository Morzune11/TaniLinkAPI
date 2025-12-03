<?php

use Illuminate\Support\Facades\Route;


Route::get('/test-route', function () {
    return 'Route OK';
});
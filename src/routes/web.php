<?php

use Illuminate\Support\Facades\Route;

Route::get('/msg4wrd', [KPAPH\MSG4wrdIO\Http\Controllers\SampleController::class, 'ShowStatus']);
Route::get('/msg4wrd/send', [KPAPH\MSG4wrdIO\Http\Controllers\SampleController::class, 'DemoNormal']);
Route::get('/msg4wrd/send-with-options', [KPAPH\MSG4wrdIO\Http\Controllers\SampleController::class, 'DemoWithOptions']);


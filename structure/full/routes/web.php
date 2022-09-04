<?php

use Illuminate\Support\Facades\Route;
use App\DummyName\Http\Controllers\DummyController;

Route::get('DummySlug' , [DummyController::class , 'index']);
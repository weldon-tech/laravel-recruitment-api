<?php

use Illuminate\Support\Facades\Route;
use Juraboyev\LaravelRecruitmentApi\Http\Controllers\CandidateController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::post('/candidate-store', [CandidateController::class, 'createCandidate']);
    Route::get('/province-list', [CandidateController::class, 'getProvince']);
    Route::get('/region-list', [CandidateController::class, 'getRegion']);
    Route::get('/village-list', [CandidateController::class, 'getVillage']);

});

<?php

use Illuminate\Support\Facades\Route;
use Juraboyev\LaravelRecruitmentApi\Http\Controllers\CandidateController;
use Juraboyev\LaravelRecruitmentApi\Http\Controllers\SigInController;

Route::middleware('api')->prefix('api')->group(function () {
    Route::post('recruitment/generate-captcha', [SigInController::class, 'generateCaptcha']);
    Route::post('/candidate-store', [CandidateController::class, 'createCandidate']);
    Route::get('/province-list', [CandidateController::class, 'getProvince']);
    Route::get('/region-list', [CandidateController::class, 'getRegion']);
    Route::get('/village-list', [CandidateController::class, 'getVillage']);

});

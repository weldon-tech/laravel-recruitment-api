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


Route::middleware(config('recruitment.auth.middleware'))->prefix('api')->group(function () {
    Route::get('get-candidate',[CandidateController::class, 'getCandidates']);
    Route::get('get-candidate/{Candidate}',[CandidateController::class, 'getCandidateDetails']);
});
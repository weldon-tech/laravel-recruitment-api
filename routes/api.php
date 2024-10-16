<?php

use Illuminate\Support\Facades\Route;
use Juraboyev\LaravelRecruitmentApi\Http\Controllers\CandidateController;


Route::middleware('api')->prefix('api')->group(function () {
    Route::post('/candidate-store', [CandidateController::class, 'createCandidate']);
});

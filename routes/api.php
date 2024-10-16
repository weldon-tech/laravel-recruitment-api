<?php

use Illuminate\Support\Facades\Route;
use Juraboyev\LaravelRecruitmentApi\Http\Controllers\CandidateController;

Route::post('/candidate-store', [CandidateController::class, 'createCandidate']);

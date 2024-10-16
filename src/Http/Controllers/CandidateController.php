<?php

namespace Juraboyev\LaravelRecruitmentApi\Http\Controllers;

use Juraboyev\LaravelRecruitmentApi\Http\Requests\CreateCandidateRequest;

class CandidateController
{
    public function createCandidate(CreateCandidateRequest $request)
    {

        $candidate = new \Juraboyev\LaravelRecruitmentApi\Candidate\Models\Candidate($request->all());

        return  $candidate->store();

    }
}

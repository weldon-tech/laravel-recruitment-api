<?php

namespace Juraboyev\LaravelRecruitmentApi\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Juraboyev\LaravelRecruitmentApi\Http\Requests\CreateCandidateRequest;
use Juraboyev\LaravelRecruitmentApi\Models\Province;
use Juraboyev\LaravelRecruitmentApi\Models\Region;
use Juraboyev\LaravelRecruitmentApi\Models\Village;

class CandidateController
{
    public function createCandidate(CreateCandidateRequest $request)
    {
        $candidate = new \Juraboyev\LaravelRecruitmentApi\Candidate\Models\Candidate($request->all());

        return $candidate->store();

    }

    public function getProvince()
    {
        $provinces = Province::query()
            ->select('id', 'name')
            ->where('active', true)
            ->get();

        return Response::json($provinces);
    }

    public function getRegion()
    {
        $provinceId = request()->get('province_id');

        $regions = Region::query()
            ->select('id', 'name')
            ->where('active', true)
            ->where('province_id', $provinceId)
            ->get();

        return Response::json($regions);
    }

    public function getVillage()
    {

        $regionId = request()->get('region_id');

        $villages = Village::query()
            ->select('id', 'name')
            ->where('active', true)
            ->where('region_id', $regionId)
            ->get();

        return Response::json($villages);
    }
}

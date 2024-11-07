<?php

namespace Juraboyev\LaravelRecruitmentApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Juraboyev\LaravelRecruitmentApi\Http\Requests\CreateCandidateRequest;
use Juraboyev\LaravelRecruitmentApi\Http\Resources\CandidateResourceCollection;
use Juraboyev\LaravelRecruitmentApi\Models\Candidate;
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

    public function getCandidates(Request $request)
    {
        $date =  $request->date('date')?->format('Y-m-d');
        $bornDate = $request->date('born_date')?->format('Y-m-d');
        $provinceId = $request->get('province_id', null);
        $regionId = $request->get('region_id', null);
        $villageId = $request->get('village_id', null);
        $limit = $request->get('limit');
        $educationLevel = $request->get('education_level',false);

        $Candidates = Candidate::query()
            ->with([
                'address'=>fn($query)=>$query->select('candidate_id','province_id','region_id','village_id'),
                'address.province'=>fn($query)=>$query->select('id', 'name'),
                'address.region'=>fn($query)=>$query->select('id', 'name'),
                'address.village'=>fn($query)=>$query->select('id', 'name'),
            ])
            ->when($date,fn($q) => $q->whereDate('created_at', $date))
            ->when($bornDate,fn($q) => $q->whereDate('born_date', $bornDate))
            ->when($educationLevel,fn($q) => $q->where('education_level',$educationLevel))
            ->when($provinceId,fn($q) => $q->where('province_id', $provinceId))
            ->when($regionId,fn($q) => $q->where('region_id', $regionId))
            ->when($villageId,fn($q) => $q->where('village_id', $villageId))
            ->orderBy('id','DESC')
            ->simplePaginate($limit);

        return CandidateResourceCollection::collection($Candidates);
    }

    public  function getCandidateDetails($candidateId)
    {

     $candidate = Candidate::query()
        ->where('id', $candidateId)
        ->with([
            'address'=>fn($query)=>$query->select('candidate_id','province_id','region_id','village_id'),
            'address.province'=>fn($query)=>$query->select('id', 'name'),
            'address.region'=>fn($query)=>$query->select('id', 'name'),
            'address.village'=>fn($query)=>$query->select('id', 'name'),
            'candidate_advertising_sources',
            'candidate_details',
            'candidate_education_details',
            'candidate_experiences',
            'candidate_family_members',
            'candidate_lang_skills',
            'candidate_other_skills',
            'candidate_selected_positions'
        ])
        ->first();

        return $candidate;
    }
}

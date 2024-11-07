<?php

namespace Juraboyev\LaravelRecruitmentApi\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CandidateResourceCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "reg_date"=>$this->created_at->format('d.m.Y'),
            "full_name"=>$this->full_name,
            "born_date"=>$this->born_date->format('d.m.Y'),
            "photo_url"=>config('app.minio_url').'/'.config('recruitment.storage.disk').'/'.$this->photo_url,
            "phone_number"=>$this->phone_number,
            'candidate_address'=>$this->address,

        ];
    }
}

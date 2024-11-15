<?php

namespace Juraboyev\LaravelRecruitmentApi\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class CandidateResourceCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "reg_date"=>$this->created_at->format('d.m.Y'),
            "full_name"=>$this->full_name,
            "born_date"=>$this->born_date->format('d.m.Y'),
            'photo_url'=> Storage::disk(config('recruitment.storage.disk'))->temporaryUrl($this->photo_url, \Carbon\Carbon::now()->endOfDay()),
            "phone_number"=>$this->phone_number,
            'candidate_address'=>$this->address,
            'status'=>$this->status

        ];
    }
}

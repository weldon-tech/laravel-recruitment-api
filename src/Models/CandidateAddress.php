<?php

namespace Weldon\LaravelRecruitmentApi\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateAddress extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function village(){
        return $this->belongsTo(Village::class);
    }
}

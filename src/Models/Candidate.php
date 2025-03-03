<?php

namespace Weldon\LaravelRecruitmentApi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'date:d.m.Y',
        'born_date' => 'date:d.m.Y',
    ];

    public $timestamps = false;

    public function address()
    {
        return $this->hasOne(CandidateAddress::class, 'candidate_id', 'id');
    }

    public function candidate_advertising_sources()
    {
       return $this->hasMany(CandidateAdvertisingSource::class, 'candidate_id', 'id');
    }

    public function candidate_details()
    {
        return $this->hasOne(CandidateDetail::class, 'candidate_id', 'id');
    }

    public function candidate_education_details ()
    {
        return $this->hasOne(CandidateEducationDetail::class, 'candidate_id', 'id');
    }

    public function candidate_experiences (){

        return $this->hasOne(CandidateExperience::class, 'candidate_id', 'id');
    }

    public function candidate_family_members (){

        return $this->hasMany(CandidateFamilyMember::class, 'candidate_id', 'id');
    }

    public function  candidate_lang_skills (){
        return $this->hasMany(CandidateLangSkill::class, 'candidate_id', 'id');
    }

    public function candidate_other_skills ()
    {
        return $this->hasMany(CandidateOtherSkill::class, 'candidate_id', 'id');
    }

    public function  candidate_selected_positions()
    {
        return $this->hasMany(CandidateSelectedPosition::class, 'candidate_id', 'id');
    }



}

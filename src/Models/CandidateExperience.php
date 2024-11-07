<?php

namespace Juraboyev\LaravelRecruitmentApi\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'start' => 'date:d.m.Y',
        'end' => 'date:d.m.Y',
    ];
}

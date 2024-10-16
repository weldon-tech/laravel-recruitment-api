<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class AdditionalSkillsOthers
{
    public string $skillName;

    public string $level;

    public function __construct(
        $data = []
    ) {
        $this->skillName = $data['skill_name'];
        $this->level = $data['level'];
    }

    public function getSkillName(): string
    {
        return $this->skillName;
    }

    public function getLevel(): string
    {
        return $this->level;
    }
}

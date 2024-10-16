<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class AdditionalSkillsLanguages
{
    public string $language;

    public string $level;

    public function __construct(
        $data = []
    ) {
        $this->language = $data['language'];
        $this->level = $data['level'];
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getLevel(): string
    {
        return $this->level;
    }
}

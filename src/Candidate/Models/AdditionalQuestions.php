<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class AdditionalQuestions
{
    public bool $hasBadHabits;

    public string $howBadHabits;

    public function __construct(
        $data = []
    ) {
        $this->hasBadHabits = $data['has_bad_habits'];
        $this->howBadHabits = $data['how_bad_habits'];
    }

    public function getHasBadHabits(): bool
    {
        return $this->hasBadHabits;
    }

    public function getHowBadHabits(): string
    {
        return $this->howBadHabits;
    }
}

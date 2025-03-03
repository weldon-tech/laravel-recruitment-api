<?php

namespace Weldon\LaravelRecruitmentApi\Candidate\Models;

class WorkExperience
{
    public string|null $previousOrganization;

    public string|null $position;

    /** @var string[] */
    public array|null $periodEmployment;

    public string|null $reasonForDismissal;

    public  bool $hasWorkPlace;

    /**
     * @param  string[]  $periodEmployment
     */
    public function __construct(
        $data = []
    ) {
        $this->previousOrganization = $data['previous_organization'] ?? null;
        $this->position = $data['position'];
        $this->periodEmployment = $data['period_employment'];
        $this->reasonForDismissal = $data['reason_for_dismissal'];
        $this->hasWorkPlace = $data['has_work_place'];
    }

    public function getPreviousOrganization(): string
    {
        return $this->previousOrganization;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return string[]
     */
    public function getPeriodEmployment(): array
    {
        return $this->periodEmployment;
    }

    public function getReasonForDismissal(): string
    {
        return $this->reasonForDismissal;
    }

    public  function hasWorkPlace(): bool{
        return $this->hasWorkPlace;
    }
}

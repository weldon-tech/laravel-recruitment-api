<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class WorkExperience
{
    public string $previousOrganization;

    public string $position;

    /** @var string[] */
    public array $periodEmployment;

    public string $reasonForDismissal;

    /**
     * @param  string[]  $periodEmployment
     */
    public function __construct(
        $data = []
    ) {
        $this->previousOrganization = $data['previous_organization'];
        $this->position = $data['position'];
        $this->periodEmployment = $data['period_employment'];
        $this->reasonForDismissal = $data['reason_for_dismissal'];
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
}

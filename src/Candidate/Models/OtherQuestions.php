<?php

namespace Weldon\LaravelRecruitmentApi\Candidate\Models;

class OtherQuestions
{
    public string $salary;

    public string $aboutYourSelf;

    public bool $chronicDiseases;

    public bool $pregnant;

    public function __construct(
        $data = []
    ) {
        $this->salary = $data['salary'];
        $this->aboutYourSelf = $data['about_your_self'];
        $this->chronicDiseases = $data['chronic_diseases'];
        $this->pregnant = $data['pregnant'];
    }

    public function getSalary(): string
    {
        return $this->salary;
    }

    public function getAboutYourSelf(): string
    {
        return $this->aboutYourSelf;
    }

    public function getChronicDiseases(): bool
    {
        return $this->chronicDiseases;
    }

    public function getPregnant(): bool
    {
        return $this->pregnant;
    }
}

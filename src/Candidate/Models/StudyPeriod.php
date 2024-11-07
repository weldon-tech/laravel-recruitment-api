<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class StudyPeriod
{
    public string $educationalInstitution;

    public string $direction;

    public int $admissionYear;

    public int $graduationYear;

    public string $field;

    public string $educationLevel;

    public function __construct(
        $data = []
    ) {
        $this->educationalInstitution = $data['educational_institution'];
        $this->direction = $data['direction'];
        $this->admissionYear = $data['admission_year'];
        $this->graduationYear = $data['graduation_year'];
        $this->field = $data['field'];
        $this->educationLevel = $data['education_level'];
    }

    public function getEducationalInstitution(): string
    {
        return $this->educationalInstitution;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function getAdmissionYear(): int
    {
        return $this->admissionYear;
    }

    public function getGraduationYear(): int
    {
        return $this->graduationYear;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getEducationLevel(): string{

        return $this->educationLevel;
    }
}

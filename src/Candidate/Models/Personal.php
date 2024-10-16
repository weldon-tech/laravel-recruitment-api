<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class Personal
{
    public string $photo;

    public string $firstName;

    public string $lastName;

    public string $middleName;

    public string $bornDay;

    public function __construct(
        $data = []
    ) {
        $this->photo = $data['photo'];
        $this->firstName = $data['first_name'];
        $this->lastName = $data['last_name'];
        $this->middleName = $data['middle_name'];
        $this->bornDay = $data['born_day'];
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function getBornDay(): string
    {
        return $this->bornDay;
    }
}

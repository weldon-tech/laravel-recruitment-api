<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class AboutFamily
{
    public string $kinship;

    public string $fullName;

    public string $workPlace;

    public string $address;

    public function __construct(
        $data = []
    ) {
        $this->kinship = $data['kinship'];
        $this->fullName = $data['full_name'];
        $this->workPlace = $data['work_place'];
        $this->address = $data['address'];
    }

    public function getKinship(): string
    {
        return $this->kinship;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getWorkPlace(): string
    {
        return $this->workPlace;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}

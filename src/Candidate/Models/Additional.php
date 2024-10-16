<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class Additional
{
    public string $citizenship;

    public string $nation;

    public int $province;

    public int $district;

    public int $mca;

    public string $address;

    public string $phoneNumber;

    public string $additionalNumber;

    public function __construct(
        $data = []
    ) {
        $this->citizenship = $data['citizenship'];
        $this->nation = $data['nation'];
        $this->province = $data['province'];
        $this->district = $data['district'];
        $this->mca = $data['mca'];
        $this->address = $data['address'];
        $this->phoneNumber = $data['phone_number'];
        $this->additionalNumber = $data['additional_number'];
    }

    public function getCitizenship(): string
    {
        return $this->citizenship;
    }

    public function getNation(): string
    {
        return $this->nation;
    }

    public function getProvince(): int
    {
        return $this->province;
    }

    public function getDistrict(): int
    {
        return $this->district;
    }

    public function getMca(): int
    {
        return $this->mca;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getAdditionalNumber(): string
    {
        return $this->additionalNumber;
    }
}

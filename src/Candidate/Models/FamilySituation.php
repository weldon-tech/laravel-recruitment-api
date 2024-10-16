<?php

namespace Juraboyev\LaravelRecruitmentApi\Candidate\Models;

class FamilySituation
{
    public string $familySituation;

    public bool $hasChildren;

    public int $children;

    public function __construct(
        $data = []
    ) {
        $this->familySituation = $data['family_situation'];
        $this->hasChildren = $data['has_children'];
        $this->children = $data['children'];
    }

    public function getFamilySituation(): string
    {
        return $this->familySituation;
    }

    public function getHasChildren(): bool
    {
        return $this->hasChildren;
    }

    public function getChildren(): int
    {
        return $this->children;
    }
}

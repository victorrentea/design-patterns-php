<?php

namespace victor\training\architecture\domain\model;

// Value Object
readonly class Company // uneori chiar poate veni din 2 surse: ONRC, ONRC-bg
{
    private string $name;
    private string $email; // pa limba mea
    private bool $isNew;
    private string $europeanRegNumber;

    public function __construct(string $name, string $email, bool $isNew, string $europeanRegNumber)
    {
        $this->name = $name;
        $this->email = $email;
        $this->isNew = $isNew;
        $this->europeanRegNumber = $europeanRegNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEuropeanRegNumber(): string
    {
        return $this->europeanRegNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isNew(): bool
    {
        return $this->isNew;
    }

}
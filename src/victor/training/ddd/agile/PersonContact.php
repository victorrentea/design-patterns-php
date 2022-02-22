<?php

namespace victor\training\ddd\agile;

class PersonContact // Value Object
{
    private string $name;
    private ?string $email;
    private ?string $phone;

    public function __construct(string $name, ?string $email, ?string $phone)
    {
        if (!$email && !$phone) {
            throw new \Exception("Bum");
        }
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    function equals(PersonContact $contact): bool
    {
        return
            $this->name === $contact->name &&
            $this->phone === $contact->phone &&
            $this->email === $contact->email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
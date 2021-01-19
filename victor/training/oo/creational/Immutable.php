<?php


namespace victor\training\oo\creational;



/** @Entity */
class Person {   // ---->tabela PERSON(ID, FIRST_NAME, LAST_NAME)


    /** @Id */
    private int $id;

    /** @Embedded(class = "FullName") */
    private FullName $fullName;

}


/** @Embeddable */
class FullName
{
    private string $firstName;
    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function withLastName(string $newLastName):FullName
    {
        return new FullName($this->getFirstName(), $newLastName);
    }

}

$deFata = new FullName("Margareta", "Turcan");


// asta
//

// "With"ers
$deFata = $deFata->withLastName("Rentea");

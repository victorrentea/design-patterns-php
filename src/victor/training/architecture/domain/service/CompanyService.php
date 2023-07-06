<?php

namespace victor\training\architecture\domain\service;

use Exception;
use victor\training\architecture\domain\model\Company;

readonly class CompanyService
{
    public function __construct(private CompanyProvider $companyProvider)
    {
    }

    public function placeCorporateOrder(string $cif): void
    {
        $company = $this->companyProvider->findCompanyByCIF($cif);

        echo "send 'Thank you' email to " . $company->getEmail();

        if ($company->isNew()) {
            throw new Exception("Too young");
        }

        $this->deeper($company);

        echo "set order placed by {$company->getName()}";
    }

    private function deeper(Company $company) // ⚠️ useless fields
    {
        echo "set shipped to {$company->getName()}, having EU reg: " . $company->getEuropeanRegNumber();
    }
}

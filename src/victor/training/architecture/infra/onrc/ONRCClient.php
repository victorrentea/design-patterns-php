<?php

namespace victor\training\architecture\infra\onrc;

use victor\training\architecture\domain\model\Company;
use victor\training\architecture\domain\service\ONRCClientInterface;

// ADapter pattern care intermediaza apelurile catre exterior
class ONRCClient implements ONRCClientInterface
{
    private ONRCApiClient $apiClient;

    public function __construct(ONRCApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }
    function findCompanyByCIF(string $cif) : Company
    {
        // token, retry,
        $list = $this->apiClient->search(null, null, strtoupper($cif));
        if (count($list) !== 1) {
            throw new \Exception('There is no single user matching CIF ' . $cif);
        }
        return $this->fromDto($list[0]);
    }

    private function fromDto(ONRCLegalEntity $dto): Company
    {
        $name = $dto->getExtendedFullName() != null ? $dto->getExtendedFullName() : $dto->getShortName(); // ⚠️ data mapping mixed with biz logic
        $isNew = true;
        if ($dto->getRegistrationDate() != null) {
            $year = $dto->getRegistrationDate()->format('Y');  // ⚠️ pending NullPointerException
            if (date('Y') - $year >= 2) {
                $isNew = false;
            }
        }
        $eur = $dto->getEuregno();
        if ($eur === null) {
            $eur = "RO" . $dto->getOnrcId();
        }

        $company = new Company($name, $dto->getMainEml(), $isNew, $eur);
        return $company;
    }
}


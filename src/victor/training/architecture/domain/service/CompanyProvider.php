<?php

namespace victor\training\architecture\domain\service;

use victor\training\architecture\domain\model\Company;

interface CompanyProvider
{
    function findCompanyByCIF(string $cif): Company;
}
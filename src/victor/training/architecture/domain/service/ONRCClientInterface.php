<?php

namespace victor\training\architecture\domain\service;

use victor\training\architecture\domain\model\Company;

interface ONRCClientInterface
{
    function findCompanyByCIF(string $cif): Company;
}
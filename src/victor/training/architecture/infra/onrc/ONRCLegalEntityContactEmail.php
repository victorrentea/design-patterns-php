<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:29 PM
 */

namespace victor\training\architecture\infra\onrc;

class ONRCLegalEntityContactEmail
{
    private string $val;
    private ONRCLegalEntityContactEmailType $type;

    public function __construct(string $val, ONRCLegalEntityContactEmailType $type)
    {
        $this->val = $val;
        $this->type = $type;
    }

    function getVal(): string
    {
        return $this->val;
    }

    function getType(): ONRCLegalEntityContactEmailType
    {
        return $this->type;
    }

}
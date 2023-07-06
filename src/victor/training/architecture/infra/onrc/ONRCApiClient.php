<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:35 PM
 */

namespace victor\training\architecture\infra\onrc;

class ONRCApiClient
{
    /* @return ONRCLegalEntity[] */
    public function search(?string $namePart, ?string $onrcId, ?string $cif) {
        // Imagine a remoote API Call happens here returning an array of responses
        return ONRC_SampleData::getData();
    }

}
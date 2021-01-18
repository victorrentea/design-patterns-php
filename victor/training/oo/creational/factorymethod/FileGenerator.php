<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/17/2017
 * Time: 8:02 PM
 */

namespace victor\training\oo\behavioral\factorymethod;
include "OutputFile.php";

class FileGenerator
{
    public static function createAnafFile()
    {
//        $outputFile = new OutputFile("anaf", separator:",");
//        $outputFile->writeCsv("sdsadas")
        $outputFile = OutputFile::createCsvWithSemicolonSeparator("anaf");
    }
}

FileGenerator::createAnafFile();
FileGenerator::createRCFile();
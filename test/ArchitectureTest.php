<?php


use J6s\PhpArch\PhpArch;
use J6s\PhpArch\Validation\ForbiddenDependency;
use J6s\PhpArch\Validation\MustBeSelfContained;
use J6s\PhpArch\Validation\MustOnlyDependOn;

// class Test1 extends \J6s\PhpArch\Tests\TestCase
class ArchitectureTest extends \PHPUnit\Framework\TestCase
{

    public function testSimpleNamespaces()
    {
        $directory = __DIR__ . '/../src/victor';
        echo "Reading from $directory";
        (new PhpArch())
            ->fromDirectory($directory)
            ->validate(new ForbiddenDependency('victor\\training\\ddd\\agile\\b\\', 'victor\\training\\ddd\\agile\\a\\'))
            // ->validate(new MustBeSelfContained('App\\Utility'))
            // ->validate(new MustOnlyDependOn('App\\Mailing', 'PHPMailer\\PHPMailer'))
            ->assertHasNoErrors();
    }
}
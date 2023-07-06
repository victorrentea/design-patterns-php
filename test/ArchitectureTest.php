<?php


use J6s\PhpArch\PhpArch;
use J6s\PhpArch\Validation\ForbiddenDependency;
use J6s\PhpArch\Validation\MustBeSelfContained;
use J6s\PhpArch\Validation\MustOnlyDependOn;

// class Test1 extends \J6s\PhpArch\Tests\TestCase
class ArchitectureTest extends \PHPUnit\Framework\TestCase
// sau deptrac commit hook si CI test
{

    // lucruri fine (design) pazite cu teste frustrante care pica

    // daca nu intelegi de ce nu poti sa faci push, suna-ma: 07200019564 si vb, anarchitect
    public function testSimpleNamespaces()
    {
        $directory = __DIR__ . '/../src/victor';
        echo "Reading from $directory";
        // deptrack
        (new PhpArch())
            ->fromDirectory($directory)
            ->validate(new ForbiddenDependency('victor\\training\\architecture\\domain\\', 'victor\\training\\architecture\\infra\\'))
//            ->validate(new ForbiddenDependency('victor\\training\\ddd\\agile\\b\\', 'victor\\training\\ddd\\agile\\a\\'))
            // ->validate(new MustBeSelfContained('App\\Utility'))
            // ->validate(new MustOnlyDependOn('App\\Mailing', 'PHPMailer\\PHPMailer'))
            ->assertHasNoErrors();
    }
}
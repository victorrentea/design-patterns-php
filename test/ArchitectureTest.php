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
            // ->validate(new ForbiddenDependency('victor\\training\\ddd\\agile\\b\\', 'victor\\training\\ddd\\agile\\a\\'))
            ->validate(new ForbiddenDependency(
                'victor\\training\\oo\\structural\\adapter\\domain\\',
                'victor\\training\\oo\\structural\\adapter\\external\\'))
            ->validate(new ForbiddenDependency(
                'victor\\training\\oo\\structural\\service\\',
                'victor\\training\\oo\\structural\\facade\\'))
            // ->validate(new MustBeSelfContained('App\\Utility'))
            // ->validate(new MustOnlyDependOn('App\\Mailing', 'PHPMailer\\PHPMailer'))
            ->assertHasNoErrors();

        // Draga developere, daca pica testul asta si nu intelegi de ce pica, cauta-l pe Catalin sau Bogdan, ca ei stiu si-ti explica
    }
}
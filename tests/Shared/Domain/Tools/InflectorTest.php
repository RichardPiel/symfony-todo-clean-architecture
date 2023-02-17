<?php

namespace App\Tests\Shared\Tools;

use App\Shared\Tools\Inflector;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InflectorTest extends KernelTestCase
{

    /**
     * @dataProvider camelCaseProvider
     */
    public function testCamelCase($str, $expected)
    {
        $this->assertEquals($expected, Inflector::camelCase($str));
    }

    // Provider
    public static function camelCaseProvider()
    {
        return [
            ['test', 'Test'],
            ['monTest', 'MonTest'],
            ['mon test', 'MonTest'],
        ];
    }

}

?>
<?php
namespace App\Tests\TaskManager\Domain\Validator;

use App\TaskManager\Domain\Validator\Validation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValidationTest extends KernelTestCase
{
    public function testNotEmpty()
    {
        $this->assertTrue(Validation::notEmpty('test'));
        $this->assertFalse(Validation::notEmpty(''));
    }

    public function testIsNumeric()
    {
        $this->assertTrue(Validation::isNumeric(12345));
        $this->assertTrue(Validation::isNumeric('12345'));
        $this->assertFalse(Validation::isNumeric('abcde'));
    }

    public function testIsEmail()
    {
        $this->assertTrue(Validation::isEmail('test@example.com'));
        $this->assertFalse(Validation::isEmail('testexample.com'));
    }

}
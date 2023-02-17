<?php
namespace App\Tests\TaskManager\Domain\Validator;

use App\Shared\Tools\Inflector;
use App\TaskManager\Domain\RequestInterface;
use App\TaskManager\Domain\Validator\Validator;
use App\TaskManager\Domain\Validator\ValidationSet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValidatorTest extends KernelTestCase
{
    public function testIsValid()
    {
        $request = $this->getMockBuilder(RequestInterface::class)
            ->setMethods(['getField'])
            ->getMock();
        $request->method('getField')
            ->willReturn('field');

        $validationSet = $this->createMock(ValidationSet::class);

        $validator = new Validator($request);

        $validator->add('field', 'NotEmpty')
            ->validate();

        $this->assertTrue($validator->isValid());

    }
}
<?php
namespace App\Tests\TaskManager\Domain\Validator;

use App\TaskManager\Domain\RequestInterface;
use App\TaskManager\Domain\Validator\ValidationRule;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValidationRuleTest extends KernelTestCase
{

    public function testProcess()
    {
        $rule = new ValidationRule('NotEmpty', ['message' => 'The field is required']);

        $request = $this->createMock(RequestInterface::class);

        $result = $rule->process('test', $request);

        $this->assertNull($result);

        $result = $rule->process('', $request);

        $this->assertNotNull($result);
        $this->assertEquals('The field is required', $result);
    }

    public function testRuleNotExist()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The NotExist validation rule does not exist!');

        new ValidationRule('NotExist');
    }
}
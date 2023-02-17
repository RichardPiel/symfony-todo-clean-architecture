<?php

namespace App\TaskManager\Domain\Validator;
use App\TaskManager\Domain\RequestInterface;

class ValidationRule
{

    protected $rule;

    protected array $options;

    protected string $message = "The field is not valid";

    public function __construct(string $rule, $options = [])
    {
        if (isset($options['rule']) && $options['rule'] instanceof \Closure) {
            $this->rule = $options['rule'];
            unset($options['rule']);
        } else {

            if (!method_exists(Validation::class, $rule)) {
                throw new \Exception("The $rule validation rule does not exist!");
            }
            $this->rule = $rule;

        }

        $this->options = $options;

        if (isset($this->options['message'])) {
            $this->message = $this->options['message'];
            unset($this->options['message']);
        }
    }

    public function process(mixed $value = null, RequestInterface $request): ?string
    {
        if ($this->rule instanceof \Closure) {
            $callable = $this->rule;
        } else {
            $callable = [Validation::class, $this->rule];
        }

        if (!$callable($value, $request)) {
            return $this->message;
        }
        return null;
    }
}

?>
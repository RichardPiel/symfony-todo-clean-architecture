<?php 

namespace App\TaskManager\Domain\Validator;

class ValidationRule
{

    protected $rule;

    protected array $options;

    public function __construct(string $rule, $options = [])
    {

        // Check if static method exist in Validation class
        if (!method_exists(Validation::class, $rule)) {
            throw new \Exception("The $rule validation rule does not exist!");
        }

        $this->rule = $rule;
        $this->options = $options;

    }

    public function process($value)
    {
        $isCallable =[Validation::class, $this->rule];
        return $isCallable($value, ...$this->options);
    }
}

?>
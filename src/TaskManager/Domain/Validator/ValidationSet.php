<?php 

namespace App\TaskManager\Domain\Validator;


/**
 * Représente l'ensemble des règles de validation pour une propriété
 */
class ValidationSet
{

    /**
     * @var array<ValidationRule>
     */
    protected array $rules = [];

    protected string $property;

    public function add(mixed $rule, array $options = []): void
    {
        
        if (!isset($this->rules[$rule])) {
            $this->rules[$rule] = new ValidationRule($rule, $options);
        }
    }

    public function getRules(): array
    {
        return $this->rules;
    }
   

}

?>
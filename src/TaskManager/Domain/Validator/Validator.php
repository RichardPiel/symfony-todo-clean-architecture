<?php

namespace App\TaskManager\Domain\Validator;

use App\Shared\Tools\Inflector;
use App\TaskManager\Domain\RequestInterface;
use App\TaskManager\Domain\Validator\ValidationSet;

class Validator
{

    /**
     * Ensemble des propriétés soumises à validation
     *
     * @var array<ValidationSet>
     */
    protected array $fields = [];

    protected array $errors = [];

    protected bool $is_valid;

    /**
     * Objet Request à valider
     * 
     * @var RequestInterface
     */
    protected RequestInterface $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function isValid(): bool
    {
        return $this->is_valid;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Contrôle l'ensemble des validations
     *
     * @return array
     */
    public function validate(): void
    {
        foreach ($this->fields as $field => $validationSet) {
            $result = $this->processRule($field, $validationSet);
            if (!empty($result)) {
                $this->errors[$field] = $result;
            }
        }

        $this->is_valid = empty($this->errors);
    }

    public function processRule(string $field, ValidationSet $validationSet)
    {
        $fieldErrors = [];

        foreach ($validationSet->getRules() as $key => $rule) {
            $getter = 'get' . Inflector::camelCase($field);
            $result = $rule->process($this->request->{$getter}(), $this->request);
            if ($result) {
                $fieldErrors[] = $result;
            }
        }
        return $fieldErrors;
    }

    /**
     * Ajout d'une règle de validation
     *
     * @param string $field
     * @param string $rule
     * @param array $options
     * @return void
     */
    public function add(string $field, string $rule, array $options = []): self
    {
        if (!isset($this->fields[$field])) {
            $this->fields[$field] = new ValidationSet();
        }

        $this->fields[$field]->add($rule, $options);

        return $this;
    }

}

?>
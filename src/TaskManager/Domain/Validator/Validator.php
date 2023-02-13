<?php

namespace App\TaskManager\Domain\Validator;
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

    /**
     * Contrôle l'ensemble des validations
     *
     * @return array
     */
    public function validate(): array
    {

        // Doit appelée une méthode process dans ValidationRule

    }

    /**
     * Ajout d'une règle de validation
     *
     * @param string $field
     * @param string $rule
     * @param array $options
     * @return void
     */
    public function add(string $field, string $rule, string $message, array $options = []): self
    {
        if (!isset($this->fields[$field])) {
            $this->fields[$field] = new ValidationSet();
        }

        $this->fields[$field]->add($rule, $options);

        return $this;
    }
  
}

?>
<?php

namespace App\TaskManager\Domain\UseCase;

trait ResponseTrait {

    protected ?array $errors = null;

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return void
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @param string $key
     * @param string $error
     * @return void
     */
    public function setError(string $key, string $error): void
    {
        $this->errors[$key] = $error;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getError(string $key): ?string
    {
        if (isset($this->errors[$key])) {
            return $this->errors[$key];
        }

        return null;
    }
    
    public function hasError()
    {
        return !empty($this->errors);
    }
}

?>
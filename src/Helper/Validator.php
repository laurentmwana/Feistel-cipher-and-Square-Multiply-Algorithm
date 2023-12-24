<?php

namespace App\Helper;

class Validator
{
    /**
     * @var array
     */
    public array $errors = [];

    /**
     * @param array $data
     */
    public function __construct(private array $data) {}

    
    /**
     *
     * @param string $key
     * @param string $pattern
     * @param string $match
     * @return static
     */
    public function required(array $keys): static
    {
        foreach ($keys as $key) {
            if (empty($this->getData($key))) {
                $this->errors[$key] = "Ne doit pas avoir une valeur vide";
            }
        }

        return $this;
    }

    public function regex(string $key, string $pattern, string $rule = ''): static
    {
        $v = $this->getData($key);
        if (!preg_match($pattern, $v) && !empty($v)) {
            $this->errors[$key] = "doit contenir que de {$rule}";
        }

        return $this;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    private function getData(string $key): ?string
    {
        return trim($this->data[$key]) ?? null;
    }
}
<?php

namespace App\Helper;

class Form 
{

    function __construct(private array $data, private ?array $errors = null) {
        
    }
   
    /**
     * @param string $label
     * @param string $key
     * @param array $attributes
     * @return string
     */
    public function input(string $label, string $key, array $attributes = []) : string {
        [$classError, $feed] = $this->feed($key);
        $attributes['value'] = $this->getData($key);
        return "
            <label for=\"{$key}\">{$label}</label>
            <input id=\"{$key}\" name=\"{$key}\" 
                class=\"form-input {$classError}\" 
                {$this->attribute($attributes)}/>
            {$feed}
        ";
    }


    public function button(string $name, array $attributes = []): string {
        return "<button {$this->attribute($attributes)}>{$name}</button>";
    }

    private function attribute(array $attributes): ?string
    {
        if (empty($attributes)) return null;
        $attribute = [];
        foreach ($attributes as $key => $value) {
            $attribute[] = "$key=\"{$value}\"";
        }
        return join(' ', $attribute);
    }

    private function getData(string $key): ?string
    {
        return $this->data[$key] ?? null;
    }

    private function feed(string $key): array
    {
        $error = $this->errors[$key] ?? null;
        return null === $error
            ? [null, null]
            : ['input-error', "<div class=\"feed-error\">{$error}</div>"];
    }
}
<?php


namespace App\Handle;

class SquareAndMultiple
{

    /**
     * @param integer $x
     * @param integer $b
     * @param integer $n
     */
    public function __construct(private int $x, private int $b, private int $n)
    {
    }


    /**
     * @return integer
     */
    public function apply(): int
    {
        $binary_exponent = decbin($this->b);  // Convertir l'exposant en binaire

        $result = 1;
    
        for ($i = 0; $i < strlen($binary_exponent); $i++) {
            $result = ($result ** 2) % $this->n;  // Étape de "carré"
            if ($binary_exponent[$i] === '1') {
                $result = ($result * $this->x) % $this->n;  // Étape de "multiplication"
            }
        }
    
        return $result;
    }
}
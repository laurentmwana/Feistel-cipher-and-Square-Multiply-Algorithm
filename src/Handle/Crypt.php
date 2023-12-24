<?php

namespace App\Handle;

class Crypt
{
    /**
     * @var array
     */
    private array $nIndexer = [];

    private  const PI = [4, 6, 0, 2, 7, 3, 1, 5];
    private  const P = [2, 0, 1, 3];

    /**
     * @param string $n
     * @param array $keys
     */
    public function __construct(string $n, private array $keys)
    {
        $this->nIndexer = toIndexer($n);
    }

    /**
     * @return array
     */
    public function apply(): array
    {
        //  Appliquer la permutation π = 46027315
        $k = array_map(function ($value) {
            return $this->nIndexer[$value];
        }, self::PI);
        // Diviser N en deux blocs de 4 bits : N = G0||D0
        [$G0, $D0] = array_chunk($k, (count($k) / 2));
        // 4 Premier Round, calculer :
            // D1 = P(G0)⊕k1 et
            // G1 = D0 ⊕(G0 ∨k1) où P = 2013 est la permutation
        
        
        return [];
    }
}
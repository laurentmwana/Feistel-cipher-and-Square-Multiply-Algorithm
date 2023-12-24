<?php

namespace App\Handle;

/**
 * Cette classe permet de générer deux sous clé en utilisant l'algorithme de GENERATION DE CLE
 */
class Generator
{
    /**
     * @var array
     */
    public array $nIndexer = [];

    /**
     * @var array
     */
    private $h = [3, 1, 2, 0, 4, 7, 5, 6];

    private const MAX_SHIFT_ORDER = 4;

    /**
     * @param string $n
     * @param integer $ls
     * @param integer $rs
     * @param array $h
     */
    public function __construct(private string $n, private int $ls = 2, private int $rs = 1)
    {
        $this->nIndexer = toIndexer($n);
    }

    /**
     * @return array
     */
    public function apply(): array
    {
        // Appliquer la fonction de permutation H = 65274130
        $k = array_map(function ($value) {
            return $this->nIndexer[$value];
        }, $this->h);
        //  Diviser K en deux blocs de 4 bits : K = k′1 || k′2
        [$kPrime1, $kPrime2] = array_chunk($k, (count($k) / 2));
        //  k1 = k′1 ⊕ k′2 et k2 = k′2 ∧ k′
        $k1 = xorLogicGate($kPrime1, $kPrime2);
        $k2 = andLogicGate($kPrime1, $kPrime2);
        // Appliquer le décalage à gauche d’ordre 2 pour k1 et le décalage à droite d’ordre 1 pour k2
        //  Sortie : Deux sous-clés (k1 , k2) de longueur 4.
        return ['K1' => $this->leftShiftOfOrder($k1), 'K2' => $this->rightShiftOfOrder($k2)];
    }

    /**
     * Fait le décalage de gauche
     *
     * @param array $k
     * @return array
     */
    public function leftShiftOfOrder(array $k): array
    {
        return $this->rs === self::MAX_SHIFT_ORDER
            ? array_reverse($k)
            : array_merge(array_splice($k, $this->ls), array_splice($k, 0, $this->ls));
    }

    /**
     * Fait le décalage de droite
     * 
     * @param array $k
     * @return array
     */
    public function rightShiftOfOrder(array $k): array
    {
        return $this->rs === self::MAX_SHIFT_ORDER
            ? array_reverse($k)
            : array_merge(array_splice($k, $this->rs * (- 1)), array_splice($k, 0));
    }
}
<?php

/**
 * Permet de générer l'url
 * @param string $title
 * @param string $path
 * @return string
 */
function url(string $title, string $path) : string 
{
    $active = explode('?', $_SERVER['REQUEST_URI'])[0] === $path ? 'active' : null;
    return "<a class=\"header-link $active\" href=\"{$path}\">{$title}</a>";
}


/**
 * @param string $path
 * @param array $params
 * @return string
 */
function generateUrl(string $path, array $params = []) : string 
{
    return !empty($params) ? $path. '?' . http_build_query($params) : $path;
}


/**
 * Permet d'indexer une chaine de caractères
 * @param string $n
 * @return array
 */
function toIndexer(string $n) : array {
    return array_map('intval', str_split($n));
}


/**
 * Applique le XOR entre deux tableau de même taille
 *
 * @param array $a
 * @param array $b
 * @param integer $lenght = 4
 * @return array
 */
function xorLogicGate(array $a, array $b, int $lenght = 4) : array {
    $xor = [];
    for ($index = 0; $index  < $lenght; $index++) {
        $xor[] = $a[$index] != $b[$index] ? 1 : 0;
    }
    return $xor;
}

/**
 * Applique le ET entre deux tableau de même taille
 * 
 * @param array $a
 * @param array $b
 * @param integer $lenght
 * @return array
 */
function andLogicGate(array $a, array $b, int $lenght = 4) : array {
    $and = [];
    for ($index = 0; $index  < $lenght; $index++) {
        $and[] = $a[$index] && $b[$index] === 1 ? 1 : 0;
    }
    return $and;
}

/**
 * @param array $array
 * @param string $namer
 * @return string|null
 */
function toString(string $namer, array $array) : ?string {
    return empty($array) ? null : $namer. ' : ' .join(' ', $array);
}

/**
 * @param array $array
 * @return string|null
 */
function separator(array $array) : ?string {
    if (empty($array)) {
        return null;
    }
    
    $separators = [];
    foreach ($array as $key => $value) {
        $separators[] = toString($key, $value);
    }
    return join(' , ', $separators);
}

/**
 * @param string $path
 * @param array $params
 * @return void
 */
function redirect(string $path, array $params = []): void
{
    $query = empty($params) ? null : '?'. http_build_query($params);
    header("Location: {$path}{$query}", true, 301);
    exit();
}
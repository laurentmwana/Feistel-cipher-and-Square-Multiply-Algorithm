<?php

/**
 * Permet de générer l'url
 *
 * @param string $title
 * @param string $path
 * @return string
 */
function url(string $title, string $path) : string 
{
    $active = explode('?', $_SERVER['REQUEST_URI'])[0] === $path ? 'active' : null;
    return "<a class=\"header-link $active\" href=\"{$path}\">{$title}</a>";
}
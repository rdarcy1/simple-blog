<?php

/**
 * Return true if form method cannot be passed directly, and so must be spoofed.
 *
 * @param $method
 * @return bool
 */
function methodMustBeSpoofed($method)
{
    return in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']);
}

/**
 * Limit $input to range defined by $min and $max.
 * 
 * @param $input
 * @param $min
 * @param $max
 * @return mixed
 */
function clamp($input, $min, $max) {
    return max($min, min($max, $input));
}
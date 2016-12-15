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
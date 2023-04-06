<?php

function urlIs($value)
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $value;
}

function base_path($path)
{
    return BASE_PATH . $path;
}
<?php

function env(string $variable, mixed $default = null): mixed
{
    return $_ENV[$variable] ?? $default;
}

function env_production(): bool
{
    return !env_development();
}

function env_development(): bool
{
    return env('APP_DEBUG');
}
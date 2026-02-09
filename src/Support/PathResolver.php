<?php

namespace Vendor\EnterpriseStructure\Support;

class PathResolver
{
    public static function domainBase(): string
    {
        return config('enterprise-structure.paths.domains');
    }

    public static function applicationBase(): string
    {
        return config('enterprise-structure.paths.application');
    }

    public static function domainActionPath(string $domain, string $class): string
    {
        return self::domainBase()
            . DIRECTORY_SEPARATOR
            . $domain
            . DIRECTORY_SEPARATOR
            . 'Actions'
            . DIRECTORY_SEPARATOR
            . $class . '.php';
    }

    public static function useCasePath(string $domain, string $class): string
    {
        return self::applicationBase()
            . DIRECTORY_SEPARATOR
            . $domain
            . DIRECTORY_SEPARATOR
            . 'UseCases'
            . DIRECTORY_SEPARATOR
            . $class . '.php';
    }
}

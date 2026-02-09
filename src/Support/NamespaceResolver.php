<?php

namespace Vendor\EnterpriseStructure\Support;

class NamespaceResolver
{
    public static function domainAction(string $domain): string
    {
        return config('enterprise-structure.namespaces.domains')
            . "\\{$domain}\\Actions";
    }

    public static function useCase(string $domain): string
    {
        return config('enterprise-structure.namespaces.application')
            . "\\{$domain}\\UseCases";
    }
}

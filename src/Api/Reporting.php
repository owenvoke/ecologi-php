<?php

declare(strict_types=1);

namespace OwenVoke\Ecologi\Api;

class Reporting extends AbstractApi
{
    public function totalImpact(string $username): array
    {
        return $this->get(sprintf('/users/%s/impact', rawurlencode($username)));
    }

    public function totalNumberOfTrees(string $username): array
    {
        return $this->get(sprintf('/users/%s/trees', rawurlencode($username)));
    }

    public function totalTonnesOfCarbonOffset(string $username): array
    {
        return $this->get(sprintf('/users/%s/carbon-offset', rawurlencode($username)));
    }
}

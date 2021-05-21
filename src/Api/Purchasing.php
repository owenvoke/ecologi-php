<?php

declare(strict_types=1);

namespace OwenVoke\Ecologi\Api;

class Purchasing extends AbstractApi
{
    public const UNIT_TONNES = 'Tonnes';
    public const UNIT_KG = 'KG';

    public function trees(int $number, ?string $name = null, bool $test = false): array
    {
        return $this->post('/impact/trees', [
            'number' => $number,
            'name' => $name,
            'test' => $test,
        ]);
    }

    public function carbonOffset(int $number, ?string $units = self::UNIT_TONNES, bool $test = false): array
    {
        return $this->post('/impact/carbon-offset', [
            'number' => $number,
            'units' => $units ?? self::UNIT_TONNES,
            'test' => $test,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace OwenVoke\Ecologi\Api;

class Purchasing extends AbstractApi
{
    public function trees(int $number, string $name = null, bool $test = false): array
    {
        return $this->post('/impact/trees', [
            'number' => $number,
            'name' => $name,
            'test' => $test,
        ]);
    }

    public function carbonOffset(int $number, string $units = 'Tonnes', bool $test = false): array
    {
        return $this->post('/impact/carbon-offset', [
            'number' => $number,
            'units' => $units,
            'test' => $test,
        ]);
    }
}

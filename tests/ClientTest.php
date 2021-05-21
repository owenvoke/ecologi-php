<?php

declare(strict_types=1);

use OwenVoke\Ecologi\Api\Purchasing;
use OwenVoke\Ecologi\Api\Reporting;
use OwenVoke\Ecologi\Client;

it('gets instances from the client', function () {
    $client = new Client();

    // Retrieves Purchasing instance
    expect($client->purchase())->toBeInstanceOf(Purchasing::class);
    expect($client->purchasing())->toBeInstanceOf(Purchasing::class);

    // Retrieves Reporting instance
    expect($client->report())->toBeInstanceOf(Reporting::class);
    expect($client->reporting())->toBeInstanceOf(Reporting::class);
});

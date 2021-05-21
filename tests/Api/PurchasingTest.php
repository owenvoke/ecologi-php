<?php

declare(strict_types=1);

use OwenVoke\Ecologi\Api\Purchasing;

beforeEach(fn () => $this->apiClass = Purchasing::class);

it('should purchase trees', function () {
    $expectedArray = [
        'amount' => 5, 'currency' => 'GBP', 'name' => 'Owen Voke',
        'treeUrl' => 'https://ecologi.com/test?tree=604a74856345f7001caff578',
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('post')
        ->with('/impact/trees', [
            'number' => 5,
            'name' => 'Owen Voke',
            'test' => true,
        ])
        ->willReturn($expectedArray);

    expect($api->trees(5, 'Owen Voke', true))->toBe($expectedArray);
});

it('should purchase carbon offset', function () {
    $expectedArray = ['number' => 1, 'units' => 'KG', 'numberInTonnes' => 0.001, 'amount' => '3', 'currency' => 'GBP'];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('post')
        ->with('/impact/carbon-offset', [
            'number' => 1,
            'units' => 'KG',
            'test' => true,
        ])
        ->willReturn($expectedArray);

    expect($api->carbonOffset(1, 'KG', true))->toBe($expectedArray);
});

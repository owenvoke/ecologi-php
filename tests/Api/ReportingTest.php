<?php

declare(strict_types=1);

use OwenVoke\Ecologi\Api\Reporting;

beforeEach(fn () => $this->apiClass = Reporting::class);

it('should get the total impact for a user', function () {
    $expectedArray = ['trees' => 1000, 'carbonOffset' => 10];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/owenvoke/impact')
        ->will($this->returnValue($expectedArray));

    expect($api->totalImpact('owenvoke'))->toBe($expectedArray);
});

it('should get the total trees for a user', function () {
    $expectedArray = ['total' => 1000];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/owenvoke/trees')
        ->will($this->returnValue($expectedArray));

    expect($api->totalNumberOfTrees('owenvoke'))->toBe($expectedArray);
});

it('should get the total tonnes of carbon offset for a user', function () {
    $expectedArray = ['total' => 1000];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/users/owenvoke/carbon-offset')
        ->will($this->returnValue($expectedArray));

    expect($api->totalTonnesOfCarbonOffset('owenvoke'))->toBe($expectedArray);
});

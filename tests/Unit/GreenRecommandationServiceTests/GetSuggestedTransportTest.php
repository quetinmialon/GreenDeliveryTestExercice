<?php

namespace Tests\Unit\GreenRecommendationService;

use App\GreenRecommendationService;
use App\CarbonCalculator;
use PHPUnit\Framework\TestCase;

use const DISTANCE_LIMIT;

class GetSuggestedTransportTest extends TestCase
{
    private GreenRecommendationService $service;
    private $calculatorMock;

    protected function setUp(): void
    {
        $this->service = new GreenRecommendationService(new CarbonCalculator);
    }

    public function test_throws_exception_if_distance_exceeds_limit()
    {
        //arrange 
        $waytoBigDistance = DISTANCE_LIMIT + 100;
        //expect
        $this->expectException(\InvalidArgumentException::class);
        //act
        $this->service->getSuggestedTransport($waytoBigDistance, 10, 100);
    }

    public function test_returns_transport_with_lowest_emission_among_valid_options()
    {
        //arrange
        $distance = 10;
        $weight = 9;
        $deadline = 1000;
        //act
        $result = $this->service->getSuggestedTransport($distance, $weight, $deadline);
        //assert
        $this->assertEquals('vélo', $result);
    }

    public function test_throws_exception_if_no_transport_fits_constraints()
    {

        //arrange 
        $distance = 4000;
        $weight = 1500;
        $deadline = 5;

        //expect
        $this->expectException(\RuntimeException::class);

        //act
        $this->service->getSuggestedTransport($distance, $weight, $deadline);
    }
    public function test_getSuggestedTransport_prefers_lower_emission_option()
    {
        // Given
        $calculator = new CarbonCalculator();
        $service = new GreenRecommendationService($calculator);

        $distance = 20;
        $weight = 15; 
        $deadline = 1;     

        // When
        $result = $service->getSuggestedTransport($distance, $weight, $deadline);

        // Then
        $this->assertEquals('véhicule électrique', $result);
    }
}

<?php

namespace Tests\Unit\GreenRecommendationService;

use App\GreenRecommendationService;
use App\CarbonCalculator;
use PHPUnit\Framework\TestCase;

use const SPEEDS;

class CalculateTimeEstimationTest extends TestCase
{
    private GreenRecommendationService $service;

    protected function setUp(): void
    {
        $this->service = new GreenRecommendationService(new CarbonCalculator);
    }

    public function test_calculate_estimation_on_valid_transport_and_distance()
    {
        $transportType = 'camionnette diesel';
        $distance = 1000;
        $expected = $distance / SPEEDS[strtolower($transportType)];

        $result = $this->service->calculateTimeEstimation($distance, $transportType);

        $this->assertIsFloat($result);
        $this->assertEquals($expected, $result);
    }

    public function test_throws_exception_if_transport_type_is_unknown()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->calculateTimeEstimation(100, 'moto volante');
    }

    public function test_throws_exception_if_speed_is_zero()
    {
        define('SPEEDS', ['ramolosse' => 0]);
        $this->expectException(\InvalidArgumentException::class);
        $this->service->calculateTimeEstimation(100, 'ramolosse');
    }
}

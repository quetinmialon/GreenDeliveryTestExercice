<?php

namespace tests\Unit\CarbonCalculatorTests;

use PHPUnit\Framework\TestCase;
use App\CarbonCalculator;
use InvalidArgumentException;
use const EMISSION_FACTORS;

class CalculateDeliveryEmissionTest extends TestCase
{
    private CarbonCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new CarbonCalculator();
    }

    public function test_calculateDeliveryEmission_returns_expected_result(): void
    {
        // Arrange
        $distance = 100.0;
        $weight = 50.0;
        $transportType = 'poids lourd';
        $expectedFactor = EMISSION_FACTORS[$transportType];

        // Act
        $emission = $this->calculator->calculateDeliveryEmission($distance, $transportType, $weight);

        // Assert
        $expectedEmission = $distance * $expectedFactor * (1 + $weight / 100);
        $this->assertEquals($expectedEmission, $emission);
    }

    public function test_calculateDeliveryEmission_throws_exception_on_invalid_distance(): void
    {
        // Assert
        $this->expectException(InvalidArgumentException::class);

        // Act
        $this->calculator->calculateDeliveryEmission(-10, 'camion', 10);
    }

    public function test_calculateDeliveryEmission_throws_exception_on_invalid_weight(): void
    {
        // Assert
        $this->expectException(InvalidArgumentException::class);

        // Act
        $this->calculator->calculateDeliveryEmission(100, 'camion', -5);
    }

    public function test_calculateDeliveryEmission_throws_exception_on_invalid_transport(): void
    {
        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Type de transport inconnu : teleportation");

        // Act
        $this->calculator->calculateDeliveryEmission(100, 'teleportation', 10);
    }
}

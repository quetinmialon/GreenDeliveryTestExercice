<?php

namespace tests\Unit\CarbonCalculatorTests;

use PHPUnit\Framework\TestCase;
use App\CarbonCalculator;
use InvalidArgumentException;
use const EMISSION_FACTORS;

class GetEmissionFactorTest extends TestCase
{
    private CarbonCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new CarbonCalculator();
    }

    public function test_getEmissionFactor_returns_correct_factor_for_known_transport(): void
    {
        // Arrange
        $transportType = 'poids lourd'; // suppose que ce type existe dans EMISSION_FACTORS

        // Act
        $factor = $this->calculator->getEmissionFactor($transportType);

        // Assert
        $this->assertIsFloat($factor);
        $this->assertEquals(EMISSION_FACTORS[$transportType], $factor);
    }

    public function test_getEmissionFactor_is_case_insensitive(): void
    {
        // Arrange
        $transportTypeUpper = 'POIDS LOURD';
        $transportTypeLower = 'poids lourd';

        // Act
        $factorUpper = $this->calculator->getEmissionFactor($transportTypeUpper);
        $factorLower = $this->calculator->getEmissionFactor($transportTypeLower);

        // Assert
        $this->assertEquals($factorLower, $factorUpper);
    }

    public function test_getEmissionFactor_throws_exception_for_unknown_type(): void
    {
        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Type de transport inconnu : licorne');

        // Act
        $this->calculator->getEmissionFactor('licorne');
    }
}

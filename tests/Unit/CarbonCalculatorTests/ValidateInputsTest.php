<?php

namespace tests\Unit\CarbonCalculatorTests;

use PHPUnit\Framework\TestCase;
use App\CarbonCalculator;
use InvalidArgumentException;
use const DISTANCE_LIMIT;

class ValidateInputsTest extends TestCase
{
    private CarbonCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new CarbonCalculator();
    }

    public function test_validateInputs_accepts_valid_inputs(): void
    {
        // Arrange
        $validDistance = 50.0;
        $validWeight = 20.0;

        // Act
        $response = $this->calculator->validateInputs($validDistance, $validWeight);

        // Assert
        $this->assertNull($response);
    }

    public function test_validateInputs_throws_exception_on_negative_distance(): void
    {
        // Arrange
        $invalidDistance = -10.0;
        $validWeight = 5.0;

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La distance et le poids ne peuvent pas être de zéro.");

        // Act
        $this->calculator->validateInputs($invalidDistance, $validWeight);
    }

    public function test_validateInputs_throws_exception_on_zero_distance(): void
    {
        // Arrange
        $invalidDistance = 0.0;
        $validWeight = 5.0;

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La distance et le poids ne peuvent pas être de zéro.");

        // Act
        $this->calculator->validateInputs($invalidDistance, $validWeight);
    }

    public function test_validateInputs_throws_exception_on_negative_weight(): void
    {
        // Arrange
        $validDistance = 50.0;
        $invalidWeight = -5.0;

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("La distance et le poids ne peuvent pas être de zéro.");

        // Act
        $this->calculator->validateInputs($validDistance, $invalidWeight);
    }

    public function test_validateInputs_throws_exception_if_weight_exceeds_maximum(): void
    {
        // Arrange
        $validDistance = 50.0;
        $maxWeight = $this->calculator->getMaximumWeightCharge();
        $invalidWeight = $maxWeight + 1;

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("aucun véhicule n'est capable de transpoter une telle charge.");

        // Act
        $this->calculator->validateInputs($validDistance, $invalidWeight);
    }

    public function test_validateInputs_throws_exception_on_distance_above_limit(): void
    {
        // Arrange
        $invalidDistance = DISTANCE_LIMIT + 1;
        $validWeight = 5.0;

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Pour des transports de plus de " . DISTANCE_LIMIT . "Km nous vous recommendons l'utilisation du train, de l'avion ou du bateau");

        // Act
        $this->calculator->validateInputs($invalidDistance, $validWeight);
    }
}

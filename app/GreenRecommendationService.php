<?php

namespace App;

require 'const.php';

use const SPEEDS;
use const WEIGHT_LIMITS;
use const DISTANCE_LIMIT;

class GreenRecommendationService
{
    private CarbonCalculator $calculator;

    public function __construct(CarbonCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function calculateTimeEstimation(float $distance, string $transportType): float
    {
        $key = strtolower($transportType);
        if (!isset(SPEEDS[$key])) {
            throw new \InvalidArgumentException("Vitesse inconnue pour le transport : $transportType");
        }
        return $distance / SPEEDS[$key];
    }

    public function isDeadlinePossible(string $transportType, float $distance, float $deadline): bool
    {
        return $this->calculateTimeEstimation($distance, $transportType) <= $deadline;
    }

    public function getSuggestedTransport(float $distance, float $weight, float $deadline): string
    {
        if($distance > DISTANCE_LIMIT)
        {
            throw new \InvalidArgumentException("Pour des transports de plus de ".DISTANCE_LIMIT."Km nous vous recommendons l'utilisation du train, de l'avion ou du bateau");
        }
        $options = array_keys(WEIGHT_LIMITS);
        $Possible = [];

        foreach ($options as $type) {
            if ($weight <= WEIGHT_LIMITS[$type] &&
                $this->isDeadlinePossible($type, $distance, $deadline)) {
                $Possible[] = $type;
            }
        }

        if (empty($Possible)) {
            throw new \RuntimeException("Aucun transport disponible pour les contraintes données.");
        }

        $best = $Possible[0];
        $bestEmission = $this->calculator->calculateDeliveryEmission($distance, $best, $weight);

        foreach ($Possible as $type) {
            $emission = $this->calculator->calculateDeliveryEmission($distance, $type, $weight);
            if ($emission < $bestEmission) {
                $best = $type;
                $bestEmission = $emission;
            }
        }

        return $best;
    }    
}

<?php



namespace App;

require 'const.php';

use const EMISSION_FACTORS;
use const WEIGHT_LIMITS;
use const DISTANCE_LIMIT;

class CarbonCalculator
{

    public function validateInputs(float $distance, float $weight): void
    {
        if ($distance <= 0 || $weight < 0) 
        {
            throw new \InvalidArgumentException("La distance et le poids ne peuvent pas être de zéro.");
        }
        if ($weight > $this->getMaximumWeightCharge())
        {
            throw new \InvalidArgumentException("aucun véhicule n'est capable de transpoter une telle charge.");
        }
        if($distance > DISTANCE_LIMIT)
        {
            throw new \InvalidArgumentException("Pour des transports de plus de ".DISTANCE_LIMIT."Km nous vous recommendons l'utilisation du train, de l'avion ou du bateau");
        }
    }

    public function getEmissionFactor(string $transportType): float
    {
        $key = strtolower($transportType);
        if (!array_key_exists($key, EMISSION_FACTORS)) {
            throw new \InvalidArgumentException("Type de transport inconnu : $transportType");
        }
        return EMISSION_FACTORS[$key];
    }

    public function calculateDeliveryEmission(float $distance, string $transportType, float $weight): float
    {
        $this->validateInputs($distance, $weight);
        $factor = $this->getEmissionFactor($transportType);
        return $distance * $factor * (1 + $weight / 100);
    }

    public function getMaximumWeightCharge():int
    {
        $max_weight = 0;
        foreach (WEIGHT_LIMITS as $type => $limit)
        {
            if ($max_weight < $limit)
            {
                $max_weight = $limit;
            }
        }
        return $max_weight;
    }
}

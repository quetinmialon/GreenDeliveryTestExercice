<?php

namespace Tests\Unit\GreenRecommendationService;

use App\GreenRecommendationService;
use App\CarbonCalculator;
use PHPUnit\Framework\TestCase;

use const SPEEDS;

class IsDeadlinePossibleTest extends TestCase
{
    private GreenRecommendationService $service;

    protected function setUp(): void
    {
        $this->service = new GreenRecommendationService(new CarbonCalculator);
    }

    public function test_returns_true_when_deadline_is_possible()
    {
        $transport = 'camionnette diesel';
        $distance = 100;
        $speed = SPEEDS[strtolower($transport)];
        $deadline = ($distance / $speed) + 1;

        $this->assertTrue($this->service->isDeadlinePossible($transport, $distance, $deadline));
    }

    public function test_returns_false_when_deadline_is_too_short()
    {
        $transport = 'camionnette diesel';
        $distance = 100;
        $speed = SPEEDS[strtolower($transport)];
        $deadline = ($distance / $speed) - 1;

        $this->assertFalse($this->service->isDeadlinePossible($transport, $distance, $deadline));
    }
}

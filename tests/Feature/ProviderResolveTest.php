<?php

namespace Tests\Feature;

use App\Exceptions\InvalidStrategyException;
use App\Helpers\NewsProviderResolver;
use App\Services\GuardianService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProviderResolveTest extends TestCase
{
    #[Test]
    public function it_can_resolve_a_provider_given_a_strategy(): void
    {
        $provider = NewsProviderResolver::resolveNewsProvider('guardian');

        $this->assertTrue($provider instanceof GuardianService);
    }

    #[Test]
    public function it_throws_invalid_strategy_exception_when_given_wrong_strategy(): void
    {
        $exception = null;

        try {
            NewsProviderResolver::resolveNewsProvider('guardian2');
        } catch(\Exception $e) {
            $exception = $e;
        }

        $this->assertTrue($exception instanceof InvalidStrategyException);
    }
}

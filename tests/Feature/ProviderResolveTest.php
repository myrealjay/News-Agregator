<?php

namespace Tests\Feature;

use App\Exceptions\InvalidStrategyException;
use App\Helpers\NewsProviderResolver;
use App\Services\GuardianService;
use Tests\TestCase;

class ProviderResolveTest extends TestCase
{
    /**
     * Verify that it can resolve a provider when given stragety
     * @test
     */
    public function it_can_resolve_a_provider_given_a_strategy(): void
    {
        $provider = NewsProviderResolver::resolveNewsProvider('guardian');

        $this->assertTrue($provider instanceof GuardianService);
    }

    /**
     * Check that InvalidStrageyException is thrown.
     *
     * @test
     */
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

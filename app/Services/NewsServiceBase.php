<?php

namespace App\Services;

use App\Contracts\NewsProviderContract;

abstract class NewsServiceBase implements NewsProviderContract
{
    /** @var int */
    protected int $page = 1;

    /** @var bool */
    protected bool $hasData = true;

    /** @var bool */
    protected bool $isInitialRequest = true;

    /**
     * @inheritDoc
     */
    public function hasNext(): bool
    {
        if ($this->isInitialRequest) return true;
        if ($this->hasData) return true;
        return false;
    }
}

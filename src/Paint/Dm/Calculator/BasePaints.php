<?php

namespace Paint\Dm\Calculator;

use Paint\Dm\Calculator\Exception\NotEnoughPaintsProvidedException;
use Paint\Dm\Calculator\Exception\PaintsEmptyException;
use Paint\Dm\Core\Paint;

class BasePaints
{
    private array $items;

    public function __construct(Paint ...$paints)
    {
        if (!\count($paints)) {
            throw new NotEnoughPaintsProvidedException('No base paints provided');
        }

        $paints = $this->filterOutEmpty(...$paints);

        if (!\count($paints)) {
            throw new PaintsEmptyException('Paint containers are empty');
        }

        $this->items = $paints;
    }

    /**
     * @return Paint[]
     */
    private function filterOutEmpty(Paint ...$paints): array
    {
        return \array_filter($paints, function(Paint $paint) {
            return !$paint->isEmpty();
        });
    }

    /**
     * @return Paint[]
     */
    public function toArray(): array
    {
        return $this->items;
    }
}
<?php

namespace Paint\Dm\Calculator;

use Paint\Dm\Core\Color;

class ColorFactorSpecification
{
    private ColorFactor $colorFactor;
    private float $value;

    public function __construct(ColorFactor $colorFactor, float $value)
    {
        $this->colorFactor = $colorFactor;
        $this->value = $value;
    }

    public function isSatisfiedBy(Color $color, float $maxDiff): bool
    {
        return match($this->colorFactor) {
            ColorFactor::RED => $this->isValueWithinAllowedDiff($color->getR(), $maxDiff),
            ColorFactor::GREEN => $this->isValueWithinAllowedDiff($color->getG(), $maxDiff),
            ColorFactor::BLUE => $this->isValueWithinAllowedDiff($color->getB(), $maxDiff),
            ColorFactor::ALPHA => $this->isValueWithinAllowedDiff($color->getA(), $maxDiff),
        };
    }

    private function isValueWithinAllowedDiff(float $value, float $toleration): bool
    {
        return ($this->value > .5 && $value >= $this->value) ||
            ($this->value < .5 && $value <= $this->value) ||
            ($this->value === .5 && $value === .5);
    }
}
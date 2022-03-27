<?php

namespace Paint\Dm\Calculator;

use Paint\Dm\Core\Color;

class ColorSpecification
{
    /**
     * @var ColorFactorSpecification[]
     */
    private array $specifications;

    public function __construct(Color $color)
    {
        $this->specifications = [];

        $this->specifications['r'] =
            new ColorFactorSpecification(ColorFactor::RED, $color->getR());
        $this->specifications['g'] =
            new ColorFactorSpecification(ColorFactor::GREEN, $color->getG());
        $this->specifications['b'] =
            new ColorFactorSpecification(ColorFactor::BLUE, $color->getB());
        $this->specifications['a'] =
            new ColorFactorSpecification(ColorFactor::ALPHA, $color->getA());
    }

    public function isSatisfied(Color $otherColor, float $toleration): array
    {
        $result = [];

        foreach($this->specifications as $key => $specification) {
            $result[$key] = $specification->isSatisfiedBy($otherColor, $toleration);
        }

        return $result;
    }
}
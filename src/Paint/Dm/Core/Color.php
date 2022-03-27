<?php

namespace Paint\Dm\Core;

use InvalidArgumentException;

class Color
{
    private float $r;
    private float $g;
    private float $b;
    private float $a;

    public function __construct(float $r, float $g, float $b, float $a = 1)
    {
        $this->assertNormalizedValue($r, $g, $b, $a);

        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }

    public function getR(): float
    {
        return $this->r;
    }

    public function getG(): float
    {
        return $this->g;
    }

    public function getB(): float
    {
        return $this->b;
    }

    public function getA(): float
    {
        return $this->a;
    }

    public function toneTo(self $other, float $crossPoint): self
    {
        $this->assertNormalizedValue($crossPoint);

        return new self(
            $this->getR() - (($this->getR() - $other->getR()) * $crossPoint),
            $this->getG() - (($this->getG() - $other->getG()) * $crossPoint),
            $this->getB() - (($this->getB() - $other->getB()) * $crossPoint),
            $this->getA() - (($this->getA() - $other->getA()) * $crossPoint),
        );
    }

    public function difference(self $other): float
    {
        return \abs($this->getR() - $other->getR()) +
        \abs($this->getG() - $other->getG()) +
        \abs($this->getB() - $other->getB()) +
        \abs($this->getA() - $other->getA());
    }

    private function assertNormalizedValue(float ...$values)
    {
        foreach($values as $value) {
            if ($value > 1 || $value < 0) {
                $message = \sprintf('$value should be a float value between 0 and 1, %s given', $value);
                throw new InvalidArgumentException($message);
            }
        }
    }
}
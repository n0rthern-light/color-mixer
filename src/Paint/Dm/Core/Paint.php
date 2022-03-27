<?php

namespace Paint\Dm\Core;

class Paint
{
    private Color $color;
    private float $capacity;

    public function __construct(Color $color, float $capacity)
    {
        $this->color = $color;
        $this->capacity = $capacity;
    }

    public function getColor(): Color
    {
        return $this->color;
    }

    public function getCapacity(): float
    {
        return $this->capacity;
    }

    public function isEmpty(): bool
    {
        return $this->getCapacity() <= 0;
    }

    public function mixIn(self $other): self
    {
        $sum = $this->getCapacity() + $other->getCapacity();
        $ratio = $this->getCapacity() / $other->getCapacity();
        $crossPoint = $ratio / $sum;

        return new self(
            $this->getColor()->toneTo($other->getColor(), $crossPoint),
            $sum
        );
    }
}
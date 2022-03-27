<?php

namespace Paint\Dm\Calculator;

use Paint\Dm\Core\Paint;

class PaintRecipe
{
    private Paint $targetPaint;
    /** @var Paint[] */
    private array $ingredients;

    public function __construct(Paint $targetPaint, Paint ...$ingredients)
    {
        $this->targetPaint = $targetPaint;
        $this->ingredients = $ingredients;
    }

    public function getTargetPaint(): Paint
    {
        return $this->targetPaint;
    }

    /**
     * @return Paint[]
     */
    public function getIngredientsArray(): array
    {
        return $this->ingredients;
    }
}
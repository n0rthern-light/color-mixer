<?php

namespace Paint\Dm\Calculator;

use Paint\Dm\Core\Paint;

class PaintRecipeCalculator
{
    private const TARGET_COLOR_TOLERATION = .05;

    public function fromIngredients(Paint $targetPaint, BasePaints $ingredients): PaintRecipe
    {
        $specification = new ColorSpecification($targetPaint->getColor());
        foreach($ingredients->toArray() as $ingredient)
        {
            $result = $specification->isSatisfied($ingredient->getColor(), self::TARGET_COLOR_TOLERATION);
            \var_dump($result);
            echo '---------------------';
        }

        return new PaintRecipe($targetPaint, ...[]);
    }
}
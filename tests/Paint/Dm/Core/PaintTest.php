<?php

namespace Tests\Paint\Dm\Core;

use Generator;
use Paint\Dm\Core\Color;
use Paint\Dm\Core\Paint;
use PHPUnit\Framework\TestCase;

class PaintTest extends TestCase
{
    /** @dataProvider dataProviderMixingPaints */
    public function testMixingPaints(array $a, array $b, array $expected): void
    {
        $paintA = new Paint(new Color($a[0], $a[1], $a[2], $a[3]), 1);
        $paintB = new Paint(new Color($b[0], $b[1], $b[2], $b[3]), 1);

        $resultA = $paintA->mixIn($paintB);
        $resultB = $paintB->mixIn($paintA);

        $this->assertEquals($expected[0], $resultA->getColor()->getR());
        $this->assertEquals($expected[1], $resultA->getColor()->getG());
        $this->assertEquals($expected[2], $resultA->getColor()->getB());
        $this->assertEquals($expected[3], $resultA->getColor()->getA());

        $this->assertEquals($expected[0], $resultB->getColor()->getR());
        $this->assertEquals($expected[1], $resultB->getColor()->getG());
        $this->assertEquals($expected[2], $resultB->getColor()->getB());
        $this->assertEquals($expected[3], $resultB->getColor()->getA());
    }

    public function dataProviderMixingPaints(): Generator
    {
        yield [
            [1, 1, 0, 1, 1],
            [0, 0, 1, 0, 1],
            [.5, .5, .5, .5, 2],
        ];
        yield [
            [0, 0, 0, 0, 1],
            [1, 1, 1, 1, 1],
            [.5, .5, .5, .5, 2],
        ];
        yield [
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 2],
        ];
        yield [
            [1, 1, 1, 1, 1],
            [0, 0, 0, 0, 1],
            [.5, .5, .5, .5, 2],
        ];
        yield [
            [.66, .28, .41, 1, 1],
            [.15, .41, .98, .95, 1],
            [.405, .345, .695, .975, 2],
        ];
    }
}
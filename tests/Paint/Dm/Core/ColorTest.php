<?php

namespace Tests\Paint\Dm\Core;

use Generator;
use Paint\Dm\Core\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{

    /**
     * @dataProvider dataProviderToneTo
     */
    public function testToneTo(array $a, array $b, float $cpA, float $cpB, array $expectedA, array $expectedB): void
    {
        $colorA = new Color($a[0], $a[1], $a[2], $a[3]);
        $colorB = new Color($b[0], $b[1], $b[2], $b[3]);

        $fromA = $colorA->toneTo($colorB, $cpA);
        $fromB = $colorB->toneTo($colorA, $cpB);

        $this->assertEquals($expectedA[0], $fromA->getR());
        $this->assertEquals($expectedA[1], $fromA->getG());
        $this->assertEquals($expectedA[2], $fromA->getB());
        $this->assertEquals($expectedA[3], $fromA->getA());

        $this->assertEquals($expectedB[0], $fromB->getR());
        $this->assertEquals($expectedB[1], $fromB->getG());
        $this->assertEquals($expectedB[2], $fromB->getB());
        $this->assertEquals($expectedB[3], $fromB->getA());
    }

    public function dataProviderToneTo(): Generator
    {
        yield[
            [0, 0, 0, 1],
            [1, 1, 1, 1],
            .75,
            .75,
            [.75, .75, .75, 1],
            [.25, .25, .25, 1],
        ];
        yield[
            [0, 0, 0, 1],
            [1, 1, 1, 1],
            .5,
            .5,
            [.5, .5, .5, 1],
            [.5, .5, .5, 1],
        ];
        yield[
            [0, 0, 0, 1],
            [1, 1, 1, 1],
            0,
            0,
            [0, 0, 0, 1],
            [1, 1, 1, 1],
        ];
        yield[
            [0, 1, 0, 1],
            [1, 0, 0, 1],
            .5,
            .5,
            [.5, .5, 0, 1],
            [.5, .5, 0, 1],
        ];
        yield[
            [0, 1, 1, 1],
            [1, 0, 0, 1],
            .75,
            .75,
            [.75, .25, .25, 1],
            [.25, .75, .75, 1],
        ];
        yield[
            [0, 1, 1, 1],
            [1, 0, 0, 1],
            1,
            1,
            [1, 0, 0, 1],
            [0, 1, 1, 1],
        ];
        yield[
            [.65, .33, .76, .06],
            [.5, .25, .1, .5],
            .66,
            .33,
            [.551, .2772, .32439999999999997, .3504],
            [.5495, .2764, .3178, .3548],
        ];
    }
}
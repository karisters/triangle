<?php
namespace Interview\TriangleTest;

use Interview\Triangle\Exceptions\WrongSidesNumber;
use Interview\Triangle\Exceptions\WrongTriangleSideLength;
use Interview\Triangle\Side;
use Interview\Triangle\SidesCollection;
use Interview\Triangle\Triangle;

class TestTriangle extends \PHPUnit_Framework_TestCase
{
    /**
     * @param SidesCollection $sides
     * @param $expectedException
     *
     * @dataProvider testFailureInit_dataProvider
     */
    public function testFailureInit(SidesCollection $sides, $expectedException)
    {
        $this->expectException($expectedException);

        new Triangle($sides);
    }

    /**
     * @return array
     */
    public function testFailureInit_dataProvider()
    {
        return [
            'empty collection' => [
                new SidesCollection,
                WrongSidesNumber::class
            ],
            'wrong number of sides (2)' => [
                (new SidesCollection)->add(new Side('1'))->add(new Side('2')),
                WrongSidesNumber::class
            ],
            'wrong number of sides (4)' => [
                (new SidesCollection)->add(new Side('1'))->add(new Side('2'))->add(new Side('1'))->add(new Side('2')),
                WrongSidesNumber::class
            ],
            'sides are not connected' => [
                (new SidesCollection)->add(new Side('1'))->add(new Side('1'))->add(new Side('555')),
                WrongTriangleSideLength::class
            ],
        ];
    }

    /**
     * @param SidesCollection $sides
     *
     * @dataProvider testSuccessInit_dataProvider
     */
    public function testSuccessInit(SidesCollection $sides)
    {
        new Triangle($sides);
    }

    /**
     * @return array
     */
    public function testSuccessInit_dataProvider()
    {
        return [
            'exactly 3 sides in collection' => [
                (new SidesCollection)->add(new Side('1'))->add(new Side('1'))->add(new Side('1')),
            ],
            'any 2 sides sum is bigger than remaining side 1' => [
                (new SidesCollection)->add(new Side('1.1'))->add(new Side('2'))->add(new Side('3')),
            ],
            'any 2 sides sum is bigger than remaining side 2' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('3'))->add(new Side('4')),
            ],
        ];
    }

    /**
     * @param SidesCollection $sides
     * @param bool $expected
     *
     * @dataProvider testTriangleIsEquilateral_dataProvider
     */
    public function testTriangleIsEquilateral($sides, $expected)
    {
        $this->assertSame((new Triangle($sides))->isEquilateral(), $expected);
    }

    /**
     * @return array
     */
    public function testTriangleIsEquilateral_dataProvider()
    {
        return [
            'all sides are same' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('2'))->add(new Side('2')),
                true
            ],
            '1 side is distinct' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('2'))->add(new Side('3')),
                false
            ],
            'all sides are distinct' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('4'))->add(new Side('3')),
                false
            ],
        ];
    }

    /**
     * @param SidesCollection $sides
     * @param bool $expected
     *
     * @dataProvider testTriangleIsIsosceles_dataProvider
     */
    public function testTriangleIsIsosceles($sides, $expected)
    {
        $this->assertSame((new Triangle($sides))->isIsosceles(), $expected);
    }

    /**
     * @return array
     */
    public function testTriangleIsIsosceles_dataProvider()
    {
        return [
            'all sides are same' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('2'))->add(new Side('2')),
                true
            ],
            '2 sides are same' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('2'))->add(new Side('3')),
                true
            ],
            'all sides are distinct' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('4'))->add(new Side('3')),
                false
            ],
        ];
    }

    /**
     * @param SidesCollection $sides
     * @param bool $expected
     *
     * @dataProvider testTriangleIsScalene_dataProvider
     */
    public function testTriangleIsScalene($sides, $expected)
    {
        $this->assertSame((new Triangle($sides))->isScalene(), $expected);
    }

    /**
     * @return array
     */
    public function testTriangleIsScalene_dataProvider()
    {
        return [
            'all sides are same' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('2'))->add(new Side('2')),
                false
            ],
            '2 sides are same' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('2'))->add(new Side('3')),
                false
            ],
            'all sides are distinct' => [
                (new SidesCollection)->add(new Side('2'))->add(new Side('4'))->add(new Side('3')),
                true
            ],
        ];
    }
}

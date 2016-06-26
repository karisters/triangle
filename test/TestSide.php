<?php
namespace Interview\TriangleTest;

use Interview\Triangle\Exceptions\WrongSideType;
use Interview\Triangle\Exceptions\WrongSideLengthInput;
use Interview\Triangle\Side;

class TestSide extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $length
     * @param \Exception $expectedException
     *
     * @dataProvider testFailureInit_dataProvider
     */
    public function testFailureInit($length, $expectedException)
    {
        $this->expectException($expectedException);
        new Side($length);
    }

    /**
     * @return array
     */
    public function testFailureInit_dataProvider()
    {
        return [
            'empty input' => [
                '',
                WrongSideType::class
            ],
            '0 input' => [
                '0',
                WrongSideLengthInput::class
            ],
            'non-float input' => [
                'asd',
                WrongSideType::class
            ],
            'exceeding float type resolution' => [
                '1e999',
                WrongSideType::class
            ],
            'negative number' => [
                '-12',
                WrongSideLengthInput::class
            ]
        ];
    }

    /**
     * @param string $length
     * @param Side $expected
     *
     * @dataProvider testSuccessInit_dataProvider
     */
    public function testSuccessInit($length, $expected)
    {
        $side = new Side($length);

        $this->assertSame($expected, $side->getLength());
    }

    /**
     * @return array
     */
    public function testSuccessInit_dataProvider()
    {
        return [
            'int' => [
                '1',
                1.0
            ],
            'float' => [
                '2.2',
                2.2
            ]
        ];
    }
}

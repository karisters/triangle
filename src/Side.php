<?php
namespace Interview\Triangle;

class Side
{
    /**
     * @param float $length
     *
     * @throws Exceptions\NegativeLength
     * @throws Exceptions\WrongSideType
     */
    public function __construct($length)
    {
        if (false === filter_var($length, FILTER_VALIDATE_FLOAT)) {
            throw new Exceptions\WrongSideType;
        }

        if ($length <= 0) {
            throw new Exceptions\NegativeLength;
        }


    }
}

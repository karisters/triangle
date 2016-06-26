<?php
namespace Interview\Triangle;

class Side
{
    /**
     * @var float
     */
    private $length;

    /**
     * @param string $length
     *
     * @throws Exceptions\WrongSideLengthInput
     * @throws Exceptions\WrongSideType
     */
    public function __construct($length)
    {
        if (false === filter_var($length, FILTER_VALIDATE_FLOAT)) {
            throw new Exceptions\WrongSideType;
        }

        if ($length <= 0) {
            throw new Exceptions\WrongSideLengthInput;
        }

        $this->length = floatval($length);
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param Side $side
     * @return bool
     */
    public function isSameAs(Side $side)
    {
        return $this->length === $side->getLength();
    }

    /**
     * @param Side $side
     * @return bool
     */
    public function isLessThan(Side $side)
    {
        return $this->length < $side->getLength();
    }

    /**
     * @param Side $side
     * @return Side
     */
    public function add(Side $side)
    {
        return new Side($this->length + $side->getLength());
    }
}

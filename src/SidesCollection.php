<?php
namespace Interview\Triangle;

use Interview\Triangle\Exceptions\IndexOutOfBounds;

class SidesCollection
{
    /**
     * @var Side[]
     */
    private $sides = [];

    /**
     * @param Side $side
     *
     * @return $this
     */
    public function add(Side $side)
    {
        $this->sides[] = $side;

        return $this;
    }

    /**
     * @return int
     */
    public function length()
    {
        return count($this->sides);
    }

    /**
     * @param int $index
     * @return Side
     *
     * @throws IndexOutOfBounds
     */
    public function getByIndex($index)
    {
        if (!array_key_exists($index, $this->sides)) {
            throw new IndexOutOfBounds;
        }

        return $this->sides[$index];
    }
}

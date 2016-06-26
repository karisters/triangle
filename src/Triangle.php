<?php
namespace Interview\Triangle;

class Triangle
{
    /**
     * @var Side
     */
    private $s1;

    /**
     * @var Side
     */
    private $s2;

    /**
     * @var Side
     */
    private $s3;

    /**
     * @param SidesCollection $sides
     *
     * @throws Exceptions\WrongSidesNumber
     * @throws Exceptions\WrongTriangleSideLength
     */
    public function __construct(SidesCollection $sides)
    {
        if ($sides->length() !== 3) {
            throw new Exceptions\WrongSidesNumber;
        }

        $this->s1 = $sides->getByIndex(0);
        $this->s2 = $sides->getByIndex(1);
        $this->s3 = $sides->getByIndex(2);

        $this->assertSidesOfCorrectLength();
    }

    /**
     * @return bool
     */
    public function isEquilateral()
    {
        return $this->s1->isSameAs($this->s2)
        && $this->s1->isSameAs($this->s3);
    }

    /**
     * @return bool
     */
    public function isIsosceles()
    {
        return $this->s1->isSameAs($this->s2)
        || $this->s1->isSameAs($this->s3)
        || $this->s2->isSameAs($this->s3);
    }

    /**
     * @return bool
     */
    public function isScalene()
    {
        return !$this->s1->isSameAs($this->s2)
        && !$this->s1->isSameAs($this->s3);
    }

    private function assertSidesOfCorrectLength()
    {
        if (false === (
                $this->s1->isLessThan($this->s2->add($this->s3))
                && $this->s2->isLessThan($this->s1->add($this->s3))
                && $this->s3->isLessThan($this->s1->add($this->s2))
            )
        ) {
            throw new Exceptions\WrongTriangleSideLength;
        }
    }
}

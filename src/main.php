<?php

const DS = DIRECTORY_SEPARATOR;

require_once dirname(dirname(__FILE__)) . DS . 'vendor' . DS . 'autoload.php';

use Interview\Triangle;

try {

    if ($argc != 4) {
        throw new \Exception('Wrong arguments number passed');
    }

    $sidesCollection = (new Triangle\SidesCollection)
        ->add(new Triangle\Side($argv[1]))
        ->add(new Triangle\Side($argv[2]))
        ->add(new Triangle\Side($argv[3]));

    $triangle = new Triangle\Triangle($sidesCollection);

    echo sprintf("Triangle is equilateral %b\n", $triangle->isEquilateral());
    echo sprintf("Triangle is isosceles %b\n", $triangle->isIsosceles());
    echo sprintf("Triangle is scalene %b\n", $triangle->isScalene());

} catch (\Exception $e) {
    echo sprintf("An error occurred: %s\n", $e->getMessage());
}

<?php
/**
 * Randomizer
 *
 * @package walterdolce/Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace walterdolce\Randomizer\Strategy;

use walterdolce\Randomizer\RandomizerInterface;

/**
 * Class Rand
 * @package walterdolce\Randomizer
 */
class Rand implements RandomizerInterface
{

    /**
     * @var int
     */
    private $_max = 0;

    /**
     * @var int
     */
    private $_min = 0;

    /**
     * @param $min
     * @param $max
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setData($min, $max)
    {
        if (!$this->isRandomizable($min) or !$this->isRandomizable($max)) {
            throw new \InvalidArgumentException(
                sprintf('Both min and max must be integers, you passed a %s for min and %s for max',
                        gettype($min), gettype($max)));
        }
        $max_random = $this->getMaxRandom();
        $this->_min = ($min > $max_random) ? $max_random : $min;
        $this->_max = ($max > $max_random) ? $max_random : $max;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [$this->_min, $this->_max];
    }

    /**
     * @return int
     */
    public function randomize()
    {
        return \rand($this->_min, $this->_max);
    }

    /**
     * @return int
     */
    public function getMaxRandom()
    {
        return \getrandmax();
    }

    /**
     * @param $value
     * @return bool
     */
    public function isRandomizable($value)
    {
        return \is_int($value);
    }

}
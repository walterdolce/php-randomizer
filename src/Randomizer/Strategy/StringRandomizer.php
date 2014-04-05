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
 * Class StringRandomizer
 * @package walterdolce\Randomizer\Strategy
 */
class StringRandomizer implements RandomizerInterface
{
    /**
     * @var string
     */
    private $_string = '';

    /**
     * @return string
     */
    public function randomize()
    {
        return \str_shuffle($this->_string);
    }

    /**
     * @return int
     */
    public function getMaxRandom()
    {
        return \count($this->_string);
    }

    /**
     * @param $string
     *
     * @return bool
     */
    public function isRandomizable($string)
    {
        return \is_string($string);
    }

    /**
     * @param $string
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setData($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'StringRandomizer requires a string as a parameter, not a %s.',
                    gettype($string)
                ));
        }
        $this->_string = $string;
        return $this;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->_string;
    }
}

<?php
/**
 * Randomizer
 *
 * @package walterdolce/Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace walterdolce\Randomizer;


/**
 * Class Randomizer
 * @package walterdolce\Randomizer
 */
class Randomizer
{
    /**
     * @var RandomizerInterface
     */
    protected $_randomizer;

    /**
     * @param RandomizerInterface $randomizer
     */
    public function __construct(RandomizerInterface $randomizer)
    {
        $this->_randomizer = $randomizer;
    }

    /**
     * @param RandomizerInterface $randomizer
     * @return $this
     */
    public function setRandomizer(RandomizerInterface $randomizer)
    {
        $this->_randomizer = $randomizer;
        return $this;
    }

    /**
     * @return RandomizerInterface
     */
    public function getRandomizer()
    {
        return $this->_randomizer;
    }

    /**
     * @return int
     */
    public function randomize()
    {
        return $this->_randomizer->randomize();
    }

}
<?php
/**
 * Randomizer
 *
 * @package walterdolce/Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace walterdolce\Randomizer\Strategy\Profiler;

use walterdolce\Randomizer\RandomizerInterface,
    walterdolce\Randomizer\Strategy\Profiler;

/**
 * Class Profiler
 * @package walterdolce\Randomizer\Strategy\Profiler
 */
class MicrotimeProfiler implements ProfilerInterface
{
    /**
     * @var \walterdolce\Randomizer\RandomizerInterface
     */
    private $_randomizer;

    /**
     * @param RandomizerInterface $randomizer
     */
    public function __construct(RandomizerInterface $randomizer)
    {
        $this->_randomizer = $randomizer;
    }

    /**
     * @return mixed
     */
    public function start()
    {
        return $this->_now();
    }

    /**
     * @return mixed
     */
    public function stop()
    {
        return $this->_now();
    }

    /**
     * @return mixed
     */
    public function randomize()
    {
        return $this->_randomizer->randomize();
    }

    /**
     * @return mixed
     */
    private function _now()
    {
        return \microtime(true);
    }
} 
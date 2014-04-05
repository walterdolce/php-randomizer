<?php
/**
 * Randomizer
 *
 * @package walterdolce/Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace walterdolce\Randomizer\Strategy\Profiler;

/**
 * Interface Profiler
 * @package walterdolce\Randomizer\Strategy\Profiler
 */
interface ProfilerInterface
{
    /**
     * @return mixed
     */
    public function start();

    /**
     * @return mixed
     */
    public function stop();

}

<?php
/**
 * Randomizer
 *
 * @package walterdolce/Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace tests\Randomizer\Strategy\Profiler;

use walterdolce\Randomizer\Strategy\Profiler\MicrotimeProfiler;
use walterdolce\Randomizer\Strategy\MtRand;

/**
 * Class MicrotimeProfilerTest
 * @package tests\Randomizer\Strategy\Profiler
 */
class MicrotimeProfilerTest extends \PHPUnit_Framework_TestCase
{
    public function test_time_passes()
    {
        $mtrand = new MtRand();
        $rand_profiler = new MicrotimeProfiler($mtrand);
        $start_time = $rand_profiler->start();
        sleep(1);
        $this->assertTrue($start_time != $rand_profiler->stop());
    }

    public function test_microtime_randomizer_randomizes_correctly()
    {
        $profiler = new MicrotimeProfiler(new MtRand());
        $this->assertEquals(0, $profiler->randomize());
    }
}
 
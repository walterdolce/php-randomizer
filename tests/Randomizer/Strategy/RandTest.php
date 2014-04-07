<?php
/**
 * Randomizer
 *
 * @package walterdolce\Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace tests\Randomizer\Strategy;

use walterdolce\Randomizer\Strategy\Rand;

/**
 * Class RandTest
 * @package tests\Randomizer\Strategy
 */
class RandTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \walterdolce\Randomizer\Strategy\Rand
     */
    protected $_rand;

    /**
     * Provides incorrect data for Rand instantiation tests
     * @return array
     */
    public function incorrect_values_data_provider()
    {
        return [
            [0.0,0.0],
            ['',''],
            [false,false],
            [true,true],
            ['0','0'],
            ['1','1'],
            [new \stdClass(), new \stdClass()],
            [null,null]
        ];
    }

    /**
     * Provides correct data for Rand instantiation tests
     * @return array
     */
    public function correct_values_data_provider()
    {
        $mt_randmax = \mt_getrandmax();

        // negative integer limit on 32bit architectures
        $negative_mt_randmax = ((0 - $mt_randmax) - 1);

        return [
            [$mt_randmax, $mt_randmax],
            [$negative_mt_randmax, $negative_mt_randmax],
            [0, 0],
            [123, 123],
            [-123123, -123123],
            [-0, -0],
            [+213, +213],
            [0123, 0123], // octals
            [0x1A, 0x1A],  // hexadecimals
            [0b11111111, 0b11111111], // binary
        ];
    }

    public function setUp()
    {
        $this->_rand = new Rand();
    }

    public function test_native_getrandmax_returns_integer()
    {
        $this->assertEquals(true, \is_int(\getrandmax()));
    }

    public function test_nothing_happens_on_instantiation_without_params()
    {
        new Rand();
        $this->assertTrue(true);
    }

    /**
     * @param $int1
     * @param $int2
     *
     * @dataProvider correct_values_data_provider
     */
    public function test_method_isRandomizable_and_native_is_int_returns_same_results($int1, $int2)
    {
        $this->assertEquals(\is_int($int1), $this->_rand->isRandomizable($int2));
    }

    public function test_method_getMaxRandom_returns_same_as_native_getrandmax()
    {
        $this->assertEquals(\getrandmax(), $this->_rand->getMaxRandom());
    }

    public function test_method_getData_returns_zero_on_instantiation()
    {
        $this->assertEquals([0,0], $this->_rand->getData());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider incorrect_values_data_provider
     */
    public function test_throw_exception_when_data_is_not_integer($min, $max)
    {
        $this->_rand->setData($min, $max);
    }

    /**
     * @throws \InvalidArgumentException
     * @expectedException \InvalidArgumentException
     */
    public function test_rand_should_return_data_correctly()
    {
        $rand =  $this->_rand;
        $rand_max = \getrandmax();
        $rand->setData('','');
        $this->assertEquals(true, \is_array($rand->getData()));
        $this->assertEquals(0, $rand->randomize());
        $this->assertEquals(1, $rand->setData(1,1)->randomize());
        $this->assertEquals([1,1], $rand->setData(1,1)->getData());
        $this->assertEquals([2,1], $rand->setData(2,1)->getData());
        $this->assertEquals([$rand_max,$rand_max], $rand->setData($rand_max,$rand_max+1)->getData());
        $this->assertEquals([$rand_max,$rand_max], $rand->setData($rand_max+1,$rand_max+1)->getData());
    }

}
 
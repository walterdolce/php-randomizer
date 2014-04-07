<?php
/**
 * Randomizer
 *
 * @package walterdolce\Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace tests\Randomizer\Strategy;

use walterdolce\Randomizer\Strategy\MtRand;

/**
 * Class MtRandTest
 *
 * @package tests\Randomizer\Strategy
 */
class MtRandTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @var MtRand
     */
    protected $_mtRand;

    /**
     * Provides incorrect data for mtRand instantiation tests
     * @return array
     */
    public function incorrect_values_data_provider()
    {
        // On 32bit architectures this will be a double
        $double = (mt_getrandmax() + 1);
        $double = \is_int($double) ? null : $double;

        $mt_getrandmax = \mt_getrandmax();
        $negative_double = ((0 - $mt_getrandmax) - 2);
        $negative_double = \is_int($negative_double) ? null : $negative_double;

        return [
            [0.0,0.0],
            ["\n","\n"],
            ['',''],
            [false,false],
            [true,true],
            ['0','0'],
            ['1','1'],
            [new \stdClass(), new \stdClass()],
            [null,null],
            [$double,$double],
            [$negative_double,$negative_double]
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
        $this->_mtRand = new MtRand();
    }

    public function test_nothing_happens_on_instantiation_without_params()
    {
        new MtRand();
        $this->assertTrue(true);
    }

    public function test_native_mt_getrandmax_returns_integer()
    {
        $this->assertEquals(true, \is_int(\mt_getrandmax()));
    }

    /**
     * @param $int1
     * @param $int2
     *
     * @dataProvider correct_values_data_provider
     */
    public function test_method_isRandomizable_and_native_is_int_returns_same_results($int1, $int2)
    {
        $this->assertEquals(\is_int($int1), $this->_mtRand->isRandomizable($int2));
    }

    public function test_method_getMaxRandom_returns_same_value_as_native_mt_getrandmax()
    {
        $this->assertEquals(\mt_getrandmax(), $this->_mtRand->getMaxRandom());
    }

    public function test_method_getData_returns_default_values_right_after_instantiation()
    {
        $this->assertEquals([0,0], $this->_mtRand->getData());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider incorrect_values_data_provider
     */
    public function test_method_setData_throws_exception_when_data_is_not_integer($min, $max)
    {
        $this->_mtRand->setData($min, $max);
    }

    /**
     * @dataProvider correct_values_data_provider
     */
    public function test_method_setData_doesnt_throw_exception_when_data_is_integer($min, $max)
    {
        $this->_mtRand->setData($min, $max);
    }

    public function test_MtRand_should_return_data_correctly()
    {
        
        $this->assertEquals(true, \is_array($this->_mtRand->getData()));
        $this->assertEquals(0, $this->_mtRand->randomize());
        $this->assertEquals(1, $this->_mtRand->setData(1,1)->randomize());
        $this->assertEquals([1,1], $this->_mtRand->setData(1,1)->getData());
        $this->assertEquals([2,1], $this->_mtRand->setData(2,1)->getData());
    }

}
 
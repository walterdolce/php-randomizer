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
     * Provides data for mtRand instantiation tests
     * @return array
     */
    public function dataProvider()
    {
        $double = (\mt_getrandmax() + 1);
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
            [$double,$double]
        ];
    }

    public function test_native_mt_getrandmax_returns_integer()
    {
        $this->assertEquals(true, \is_int(\mt_getrandmax()));
    }

    public function test_nothing_happens_on_instantiation_without_params()
    {
        new MtRand();
        $this->assertTrue(true);
    }

    public function setUp()
    {
        $this->_mtRand = new MtRand();
    }

    public function test_is_randomizable_returns_correct_value()
    {
        $this->assertEquals(\is_int(0), $this->_mtRand->isRandomizable(0));
    }

    public function test_returns_same_max_getrandmax()
    {
        $this->assertEquals(\mt_getrandmax(), $this->_mtRand->getMaxRandom());
    }

    public function test_returns_zero_on_instantiation()
    {
        $this->assertEquals([0,0], $this->_mtRand->getData());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider dataProvider
     */
    public function test_throw_exception_when_data_is_not_integer($min, $max)
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
 
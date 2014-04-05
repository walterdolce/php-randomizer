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
     * Provides data for Rand instantiation tests
     * @return array
     */
    public function dataProvider()
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

    public function test_native_getrandmax_returns_integer()
    {
        $this->assertEquals(true, is_int(getrandmax()));
    }

    public function test_nothing_happens_on_instantiation_without_params()
    {
        new Rand();
        $this->assertTrue(true);
    }

    public function setUp()
    {
        $this->_rand = new Rand();
    }

    public function test_is_randomizable_returns_correct_value()
    {
        $this->assertEquals(\is_int(0), $this->_rand->isRandomizable(0));
    }

    public function test_returns_same_max_getrandmax()
    {
        $this->assertEquals(getrandmax(), $this->_rand->getMaxRandom());
    }

    public function test_returns_zero_on_instantiation()
    {
        $this->assertEquals([0,0], $this->_rand->getData());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider dataProvider
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
        $rand_max = getrandmax();
        $rand->setData('','');
        $this->assertEquals(true, is_array($rand->getData()));
        $this->assertEquals(0, $rand->randomize());
        $this->assertEquals(1, $rand->setData(1,1)->randomize());
        $this->assertEquals([1,1], $rand->setData(1,1)->getData());
        $this->assertEquals([2,1], $rand->setData(2,1)->getData());
        $this->assertEquals([$rand_max,$rand_max], $rand->setData($rand_max,$rand_max+1)->getData());
        $this->assertEquals([$rand_max,$rand_max], $rand->setData($rand_max+1,$rand_max+1)->getData());
    }

}
 
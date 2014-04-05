<?php
/**
 * RandomizerTest
 *
 * @package tests\Randomizer
 * @author  Walter Dolce <walterdolce@gmail.com> (https://github.com/walterdolce)
 * @license MIT
 */
namespace tests\Randomizer;

use walterdolce\Randomizer\Randomizer;
use walterdolce\Randomizer\Strategy\MtRand;
use walterdolce\Randomizer\Strategy\Rand;

/**
 * Class RandomizerTest
 * @package tests\Randomizer
 */
class RandomizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Mocked Randomizer object
     *
     * @var \walterdolce\Randomizer\Strategy\Rand
     */
    protected $_rand;

    public function setUp()
    {
        $this->_rand = new Rand();
    }

    public function test_method_getRandomizer_returns_correct_randomizer()
    {
        $randomizer = new Randomizer($this->_rand);
        $this->assertEquals($this->_rand, $randomizer->getRandomizer());
    }

    public function test_method_setRandomizer_sets_randomizer_correctly()
    {
        $mtRand = new MtRand();
        $randomizer = new Randomizer($this->_rand);
        $this->assertEquals($mtRand, $randomizer->setRandomizer($mtRand)->getRandomizer());
    }

    public function test_method_randomize_randomizes_correctly()
    {
        $rand = new Rand();
        $randomizer = new Randomizer($rand);
        $this->assertEquals(0, $randomizer->randomize());

        $rand->setData(1,1);
        $this->assertEquals(1, $randomizer->setRandomizer($rand)->randomize());
    }

}
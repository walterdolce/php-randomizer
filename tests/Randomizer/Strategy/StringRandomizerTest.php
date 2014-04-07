<?php
/**
 * Randomizer
 *
 * @package walterdolce\Randomizer
 * @author Walter Dolce <walterdolce@gmail.com (https://github.com/walterdolce)
 * @license MIT
 */
namespace tests\Randomizer\Strategy;

use walterdolce\Randomizer\Strategy\StringRandomizer;

/**
 * Class StringRandomizerTest
 *
 * @package tests\Randomizer\Strategy
 */
class StringRandomizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StringRandomizer
     */
    protected $_stringRandomizer;

    /**
     * @provides test_method_setData_must_throw_exception_when_data_is_not_string
     *
     * @return array
     */
    public function incorrect_values_data_provider()
    {
        return [
            [1],[0.0],[0],[true],[false],[new \stdClass()],[null]
        ];
    }

    public function setUp()
    {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
                throw new \InvalidArgumentException($errstr . " on line " . $errline . " in file " . $errfile);
            });

        $this->_stringRandomizer = new StringRandomizer();
    }

    public function tearDown()
    {
        \restore_error_handler();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_native_str_shuffle_should_emit_warning_with_object_passed_as_value()
    {
        \str_shuffle(new \stdClass());
    }

    public function test_native_str_shuffle_should_return_string()
    {
        $this->assertTrue(\is_string(\str_shuffle(0.0)));
        $this->assertTrue(\is_string(\str_shuffle(0)));
        $this->assertTrue(\is_string(\str_shuffle('')));
        $this->assertTrue(\is_string(\str_shuffle("\n")));
        $this->assertTrue(\is_string(\str_shuffle("\t")));
        $this->assertTrue(\is_string(\str_shuffle((\mt_getrandmax() + 1)))); // double on 32bit, not int
        $this->assertTrue(\is_string(\str_shuffle(true)));
        $this->assertTrue(\is_string(\str_shuffle(false)));
        $this->assertTrue(\is_string(\str_shuffle(null)));
        $this->assertTrue(\is_string(\str_shuffle('123123')));
        $this->assertTrue(\is_string(\str_shuffle('asdad')));
        $this->assertTrue(\is_string(\str_shuffle('ASCASC')));
        $this->assertTrue(\is_string(\str_shuffle('asdad123132')));
        $this->assertTrue(\is_string(\str_shuffle('ASCASCasdasd')));
        $this->assertTrue(\is_string(\str_shuffle('ASCASC213123')));
        $this->assertTrue(\is_string(\str_shuffle('ASCASCasdasd23131')));
        $this->assertTrue(\is_string(\str_shuffle('汉语'))); // chinese
        $this->assertTrue(\is_string(\str_shuffle('عرب‎'))); // arabic
        $this->assertTrue(\is_string(\str_shuffle('Έλληνες'))); // greek
        $this->assertTrue(\is_string(\str_shuffle('Ѫ ѫ'))); // cyrillic
    }

    public function test_nothing_happens_on_instantiation_without_params()
    {
        new StringRandomizer();
        $this->assertTrue(true);
    }

    /**
     * @param $data
     * @dataProvider incorrect_values_data_provider
     */
    public function test_native_is_string_returns_false_with_non_string_data($data)
    {
        $this->assertFalse(\is_string($data));
    }

    public function test_method_isRandomizable_returns_correct_value()
    {
        $this->assertTrue($this->_stringRandomizer->isRandomizable(''));
    }

    public function test_method_getMaxRandom_returns_correct_value()
    {
        $this->assertEquals(1, $this->_stringRandomizer->getMaxRandom());
        $this->assertEquals(1, $this->_stringRandomizer->setData('')->getMaxRandom());
        $this->assertEquals(1, $this->_stringRandomizer->setData('1')->getMaxRandom());
        $this->assertEquals(1, $this->_stringRandomizer->setData("\n")->getMaxRandom());
        $this->assertEquals(1, $this->_stringRandomizer->setData("\t")->getMaxRandom());
    }

    public function test_method_getData_returns_empty_string_on_instantiation()
    {
        $this->assertEquals('', $this->_stringRandomizer->getData());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider incorrect_values_data_provider
     */
    public function test_method_setData_throws_exception_with_non_string_data($data)
    {
        $this->_stringRandomizer->setData($data);
    }

    public function test_method_randomize_should_return_data_correctly()
    {
        $this->assertEquals('', $this->_stringRandomizer->randomize());
        $this->assertEquals('', $this->_stringRandomizer->setData('')->randomize());
        $this->assertEquals('a', $this->_stringRandomizer->setData('a')->randomize());
        $this->assertEquals(true, in_array($this->_stringRandomizer->setData('ab')->randomize(),['ab','ba']));
    }

}
 
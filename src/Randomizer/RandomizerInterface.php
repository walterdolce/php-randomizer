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
 * Interface RandomizerInterface
 * @package walterdolce\Randomizer
 */
interface RandomizerInterface
{
    public function randomize();
    public function isRandomizable($value);
    public function getMaxRandom();
}
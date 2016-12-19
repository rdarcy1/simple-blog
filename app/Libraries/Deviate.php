<?php

namespace App\Libraries;

class Deviate
{
    /**
     * The value around which to deviate.
     *
     * @var mixed
     */
    protected $centre;

    /**
     * Amount of deviation, expressed as a decimal ratio of the centre value.
     *
     * @var mixed
     */
    protected $deviation;

    /**
     * Whether or not generated values should be unsigned only.
     *
     * @var bool
     */
    protected $unsigned;

    /**
     * Use make() to instantiate Deviate.
     */
    protected function __construct()
    {

    }

    /**
     * Return new Deviate instance.
     *
     * @param mixed $centre
     * @param mixed $deviation
     * @param bool  $unsigned
     * @return static
     */
    public static function make($centre, $deviation, $unsigned = false)
    {
        $deviate = new static;

        $deviate->setCentre($centre);
        $deviate->setDeviation($deviation);
        $deviate->setUnsigned($unsigned);

        return $deviate;
    }

    /**
     * @return mixed
     */
    public function centre()
    {
        return $this->centre;
    }

    /**
     * Force centre to be integer.
     *
     * @param mixed $centre
     */
    public function setCentre($centre)
    {
        $this->centre = round($centre);
    }

    /**
     * @return mixed
     */
    public function deviation()
    {
        return $this->deviation;
    }

    /**
     * Force deviation to be positive.
     *
     * @param mixed $deviation
     */
    public function setDeviation($deviation)
    {
        $this->deviation = abs($deviation);
    }

    /**
     * @return bool
     */
    public function isUnsigned()
    {
        return $this->unsigned;
    }

    /**
     * @param bool $unsigned
     */
    public function setUnsigned($unsigned)
    {
        $this->unsigned = ! ! $unsigned;
    }

    /**
     * Return smallest possible value.
     *
     * @return int
     */
    public function min()
    {
        $minimum = round($this->centre - $this->centre * $this->deviation);

        return $this->unsigned ? max($minimum, 0) : $minimum;
    }

    /**
     * Return largest possible value.
     *
     * @return int
     */
    public function max()
    {
        $maximum = round($this->centre + $this->centre * $this->deviation);

        return $this->unsigned ? max($maximum, 0) : $maximum;
    }

    /**
     * Return random integer between minimum and maximum values, according to supplied deviation.
     *
     * @return int
     */
    public function random()
    {
        return rand($this->min(), $this->max());
    }

    /**
     * Return an array of random integers between min and max values.
     * Size of array specified by function parameter.
     *
     * @param mixed $numberOfValues
     * @return array
     */
    public function randomArray($numberOfValues)
    {
        $random = [];

        for ($n = 0; $n < $numberOfValues; $n++) {
            $random[] = $this->random();
        }

        return $random;
    }
}

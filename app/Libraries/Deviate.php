<?php

namespace App\Libraries;

class Deviate
{
    protected $centre;
    protected $deviation;
    protected $unsigned;

    /**
     * Deviate constructor. Deviation should be expressed as a decimal ratio.
     *
     * @param mixed $centre
     * @param mixed $deviation
     * @param bool  $unsigned
     */
    public function __construct($centre, $deviation, $unsigned = false)
    {
        $this->centre = $centre;
        $this->deviation = $deviation;
        $this->unsigned = $unsigned;
    }

    /**
     * @return mixed
     */
    public function centre()
    {
        return $this->centre;
    }

    /**
     * @param mixed $centre
     */
    public function setCentre($centre)
    {
        $this->centre = $centre;
    }

    /**
     * @return mixed
     */
    public function deviation()
    {
        return $this->deviation;
    }

    /**
     * @param mixed $deviation
     */
    public function setDeviation($deviation)
    {
        $this->deviation = $deviation;
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
        $this->unsigned = $unsigned;
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

}
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
    public function getCentre()
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
    public function getDeviation()
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
     * Return random integer between minimum and maximum values, using a
     * linear/rectangular probability density function.
     *
     * @return int
     */
    public function randomLinear()
    {
        return rand($this->min(), $this->max());
    }

    /**
     * Return a random integer between min and max values, using a triangular
     * probability density function.
     *
     * @return int
     */
    public function randomTriangular()
    {
        // Random float between 0 and 1
        $u = rand() / getrandmax();
        $a = $this->min();
        $b = $this->max();
        $c = $this->centre;
        $Fc = ($c - $a) / ($b - $a);

        if (0 < $u && $u < $Fc) {
            return $a + sqrt($u * ($b - $a) * ($c - $a));
        } else {
            return $b - sqrt((1 - $u) * ($b - $a) * ($b - $c));
        }
    }

    /**
     * Return function name based on probability density function alias.
     *
     * @param $alias
     * @return string
     */
    protected function getFunctionByAlias($alias)
    {
        switch (strtolower($alias)) {
            case 'triangular':
            case 'tpdf':
                return 'randomTriangular';
                break;
            case 'linear':
            case 'rectangular':
            case 'rpdf':
            default:
                return 'randomLinear';
                break;
        }
    }

    /**
     * Return an array of random integers between min and max values.
     * Size of array specified by function parameter.
     *
     * @param int   $numberOfValues
     * @param mixed $pdf
     * @return array
     */
    public function generate($numberOfValues = 1, $pdf = 'linear')
    {
        $random = [];
        $function = $this->getFunctionByAlias($pdf);

        for ($n = 0; $n < $numberOfValues; $n++) {
            $random[] = $this->$function();
        }

        return $random;
    }

    /**
     * Generate single random number.
     *
     * @param string $pdf
     * @return int
     */
    public function generateSingle($pdf = 'linear')
    {
        $function = $this->getFunctionByAlias($pdf);

        return $this->$function();
    }


}

<?php

/*
 * This file is part of the HGG package.
 *
 * (c) Henning Glatter-Götz <henning@glatter-gotz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HGG\Metrics;

use HGG\Metrics\Timer;

/**
 * Metrics container that allows for arbitrary variables to be tracked. The
 * constructor will optionally start a timer that reports on the elapsed time
 * between construction and the call to the toArray() method.
 *
 * @author Henning Glatter-Götz <henning@glatter-gotz.com>
 */
class Metrics
{
    protected $values = array();
    protected $timer;

    public function __construct($recordTime = false)
    {
        if ($recordTime) {
            $this->timer = new Timer();
        } else {
            $this->timer = null;
        }
  }

    /**
     * Set the name of the Metrics object.
     *
     * @param string $val Display name of the object
     */
    public function setName($val)
    {
        $this->name = $val;
    }

    /**
     * initMembers
     *
     * A quicker way to add stats items (values to track) that are initialized to
     * a the value passed to the method.
     *
     * @param array $members
     * @param int $initValue
     * @access public
     * @return void
     */
    public function initMembers(array $members, $initValue = 0)
    {
        foreach ($members as $name) {
            $this->values[$name] = $initValue;
        }
    }

    /**
     * Magic method to set a variable of an arbitrary name. This allows something
     * like the following:
     *
     * $stats->myVar = 'blabla';
     *
     * The above will create a property of name myVar with a value of 'blabla'.
     *
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $this->values[$name] = $value;
    }

    /**
     * Getter that returns the value of a property if it exists.
     *
     * @param string $name
     * @return mixed
     * @throws Exception Throws if the property does not exist
     */
    public function __get($name)
    {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        } else {
            throw new \Exception('The property '.$name.' does not exist.');
        }
    }

    /**
     * Return the results as an array
     *
     * If the timer option is on also add the elapsed time to the result array and
     * format it to hh:mm:ss if greater than one second
     *
     * @return array
     */
    public function toArray()
    {
        if ($this->timer !== null) {
            $this->values['elapsed-time'] = $this->timer->getElapsedTime(true);
        }

        return $this->values;
    }

    /**
     * toJson
     *
     * Return the result as a json encoded array
     *
     * @access public
     * @return void
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}


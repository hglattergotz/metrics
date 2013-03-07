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

/**
 * Timer
 *
 * Minimalistic timer class that is based on the Symfony 1.4 sfTimer class
 *
 * @author Henning Glatter-Götz <henning@glatter-gotz.com>
 */
class Timer
{
    protected $startTime = null;

    /**
     * Creates a new Timer instance.
     */
    public function __construct()
    {
        $this->startTimer();
    }

    /**
     * Starts the timer.
     */
    public function startTimer()
    {
        $this->startTime = microtime(true);
    }

    /**
     * Gets the total time elapsed since the timer started.
     *
     * @return float Time in seconds
     */
    public function getElapsedTime($format = false)
    {
      $elapsed = microtime(true) - $this->startTime;

      if ($format && $elapsed >= 1) {
          $elapsed = gmdate("H:i:s", $elapsed);
      }

      return $elapsed;
    }
}


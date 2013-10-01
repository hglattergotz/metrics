<?php

/*
 * This file is part of the HGG package.
 *
 * (c) 2013 Henning Glatter-Götz <henning@glatter-gotz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HGG\Metrics\Test;

use HGG\Metrics\Metrics;

class MetricsTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {}

    protected function tearDown()
    {}

    public function testTimer()
    {
        $metrics = new Metrics(true);

        $this->assertTrue(array_key_exists('elapsed-time', $metrics->toArray()));
    }

    public function testNoTimer()
    {
        $metrics = new Metrics();

        $this->assertTrue(!array_key_exists('elapsed-time', $metrics->toArray()));
    }

    public function testCounter()
    {
        $metrics = new Metrics();
        $metrics->counter = 0;
        ++$metrics->counter;

        $this->assertEquals(1, $metrics->counter);
    }
}

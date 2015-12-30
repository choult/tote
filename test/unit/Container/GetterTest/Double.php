<?php

namespace Choult\Tote\Test\Container\GetterTest;

use \Choult\Tote\Container\Getter;

/**
 * A quick and dirty double for testing the getter container
 *
 * @license http://opensource.org/licenses/MIT
 * @package Tote
 * @author Christopher Hoult <chris@choult.com>
 */
class Double extends Getter
{

    /**
    * @var array   An array storing which methods have been called
    */
    private $calls = [];

    /**
     * An example getter
     *
     * @return string
     */
    protected function getTestItem()
    {
        $this->guard('getTestItem');
        return 'test result';
    }

    /**
     * Ensures a method is called at most once
     *
     * @param string $method
     */
    private function guard($method)
    {
        if (isset($this->calls[$method])) {
            throw new \RuntimeException("Method {$method} called twice; expected at most once");
        }
        $this->calls[$method] = true;
    }
}

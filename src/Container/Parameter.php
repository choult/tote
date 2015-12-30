<?php

namespace Choult\Tote\Container;

use Choult\Tote\Container\Exception\NotFoundException;
use Choult\Tote\Container;

/**
 * A Container that is suitable for storing parameters
 *
 * @license http://opensource.org/licenses/MIT
 * @package Tote
 * @author Christopher Hoult <chris@choult.com>
 */
class Parameter extends Container
{
    /**
     * @const For no default response from get
     */
    const NO_DEFAULT = 'nodefault';

    /**
     * {@inheritdoc}
     */
    public function get($id, $default = self::NO_DEFAULT)
    {
        if (!$this->has($id)) {
            if ($default !== self::NO_DEFAULT) {
                return $default;
            }

            throw new NotFoundException("Parameter \"{$id}\" not found");
        }
        return parent::get($id);
    }
}

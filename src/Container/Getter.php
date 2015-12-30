<?php

namespace Choult\Tote\Container;

use Choult\Tote\Container\Exception\ContainerException;
use Choult\Tote\Container;

/**
 * A Container that converts dot-notation ids into a getter to call on itself
 *
 * @license http://opensource.org/licenses/MIT
 * @package Tote
 * @author Christopher Hoult <chris@choult.com>
 */
abstract class Getter extends Container
{
    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!parent::has($id)) {
            $getter = $this->getGetter($id);
            if (!\method_exists($this, $getter)) {
                throw new ContainerException("Could not find getter {$getter}");
            }
            $this->set($id, $this->{$getter}());
        }
        return parent::get($id);
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        $getter = $this->getGetter($id);
        if (parent::has($id) || \method_exists($this, $getter)) {
            return true;
        }

        return false;
    }

    /**
     * Converts a dot-notation id string into a getter
     *
     * @param  string $id
     *
     * @return string
     */
    private function getGetter($id)
    {
        return 'get' . \str_replace(' ', '', \ucwords(\str_replace('.', ' ', $id)));
    }
}

<?php

namespace Choult\Tote;

use Choult\Tote\Container\Exception\NotFoundException;
use Interop\Container\ContainerInterface as InteropContainer;

/**
 * Class Container
 *
 * @license http://opensource.org/licenses/MIT
 * @package Tote
 * @author Christopher Hoult <chris@choult.com>
 */
class Container implements ContainerInterface, InteropContainer
{
    /**
     * @type array The main array of items in this Container
     */
    private $items = [];

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if ($this->has($id)) {
            return $this->items[$id];
        }

        throw new NotFoundException("Could not find item with id \"{$id}\"");
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return (isset($this->items[$id]));
    }

    /**
     * Adds an item with the id $id to the Container
     *
     * @param string $id    The id of the item to add
     * @param mixed  $value The item to add
     */
    public function set($id, $value)
    {
        $this->items[$id] = $value;
    }
}

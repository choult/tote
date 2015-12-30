<?php

namespace Choult\Tote;

use Choult\Tote\Container\Exception\ContainerExceptionInterface;
use Choult\Tote\Container\Exception\NotFoundExceptionInterface;

/**
 * Describes the interface of a container that exposes methods to read its entries
 *
 * @see https://github.com/container-interop/fig-standards/blob/master/proposed/container.md.
 */
interface ContainerInterface
{
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for this identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id);

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundException`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has($id);
}

<?php

namespace Choult\Tote\Container\Exception;

use Interop\Container\Exception\ContainerException as InteropContainerException;

/**
 * Concrete implementation of ContainerExceptionInterface
 *
 * @license http://opensource.org/licenses/MIT
 * @package Tote
 * @author Christopher Hoult <chris@choult.com>
 */
class ContainerException extends \RuntimeException implements ContainerExceptionInterface, InteropContainerException
{

}

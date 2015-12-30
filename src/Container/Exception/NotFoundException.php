<?php

namespace Choult\Tote\Container\Exception;

use Interop\Container\Exception\NotFoundException as InteropNotFoundException;

/**
 * Concrete implementation of NotFoundExceptionInterface
 *
 * @license http://opensource.org/licenses/MIT
 * @package Tote
 * @author Christopher Hoult <chris@choult.com>
 */
class NotFoundException extends \RuntimeException implements NotFoundExceptionInterface, InteropNotFoundException
{

}

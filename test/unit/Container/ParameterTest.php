<?php

namespace Choult\Tote\Test;

use \Choult\Tote\Container\Parameter;

/**
 * @license http://opensource.org/licenses/MIT
 * @package Tote
 * @author Christopher Hoult <chris@choult.com>
 *
 * @coversDefaultClass \Choult\Tote\Container\Parameter
 */
class ParameterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * DataProvider for testGet
     *
     * @return array
     */
    public function getProvider()
    {
        return [
            'parameter exists' => [
                'contents' => [
                    'test.item' => 'test',
                    'test.item2' => 'test2'
                ],
                'id' => 'test.item',
                'expected' => 'test'
            ],
            'parameter does not exist' => [
                'contents' => [
                    'test.item' => 'test',
                    'test.item2' => 'test2'
                ],
                'id' => 'test.item3',
                'expected' => false,
                'expectedException' => '\Choult\Tote\Container\Exception\NotFoundException'
            ],
            'parameter does not exist but default passed' => [
                'contents' => [
                    'test.item' => 'test',
                    'test.item2' => 'test2'
                ],
                'id' => 'test.item3',
                'expected' => 'tested',
                'expectedException' => '',
                'default' => 'tested'
            ]
        ];
    }

    /**
     * @dataProvider getProvider
     *
     * @covers ::get
     *
     * @param array     $contents           An array of items to store, indexed by id
     * @param string    $id                 The id to pass to ::get
     * @param mixed     $expected           The expected result of ::get($id)
     * @param string    $expectedException  If set, the expected exception
     * @param mixed     $default            The default to pass to ::get
     */
    public function testGet(array $contents, $id, $expected, $expectedException = '', $default = Parameter::NO_DEFAULT)
    {
        $container = new Parameter();
        foreach ($contents as $itemId => $item) {
            $container->set($itemId, $item);
        }

        if ($expectedException) {
            $this->setExpectedException($expectedException);
        }

        $this->assertEquals($expected, $container->get($id, $default));
    }
}

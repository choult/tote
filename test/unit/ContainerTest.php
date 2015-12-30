<?php

namespace Choult\Tote\Test;

use \Choult\Tote\Container;

/**
 * @coversDefaultClass \Choult\Tote\Container
 */
class ContainerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * DataProvider for testHas
     *
     * @return array
     */
    public function hasProvider()
    {
        return [
            'id exists' => [
                'contents' => [
                    'test.item' => 'test',
                    'test.item2' => 'test2'
                ],
                'id' => 'test.item',
                'expected' => true
            ],
            'id does not exist' => [
                'contents' => [
                    'test.item' => 'test',
                    'test.item2' => 'test2'
                ],
                'id' => 'test.item3',
                'expected' => false
            ]
        ];
    }

    /**
     * @dataProvider hasProvider
     *
     * @covers ::has
     * @covers ::set
     *
     * @param array     $contents   An array of items to store, indexed by id
     * @param string    $id         The id to pass to ::has
     * @param boolean   $expected   The expected result of ::has($id)
     */
    public function testHas(array $contents, $id, $expected)
    {
        $container = new Container();
        foreach ($contents as $itemId => $item) {
            $container->set($itemId, $item);
        }

        $this->assertEquals($expected, $container->has($id));
    }

    /**
     * DataProvider for testGet
     *
     * @return array
     */
    public function getProvider()
    {
        return [
            'id exists' => [
                'contents' => [
                    'test.item' => 'test',
                    'test.item2' => 'test2'
                ],
                'id' => 'test.item',
                'expected' => 'test'
            ],
            'id does not exist' => [
                'contents' => [
                    'test.item' => 'test',
                    'test.item2' => 'test2'
                ],
                'id' => 'test.item3',
                'expected' => false,
                'expectedException' => '\Choult\Tote\Container\Exception\NotFoundException'
            ]
        ];
    }

    /**
     * @dataProvider getProvider
     *
     * @covers ::get
     * @covers ::has
     *
     * @param array     $contents           An array of items to store, indexed by id
     * @param string    $id                 The id to pass to ::get
     * @param mixed     $expected           The expected result of ::get($id)
     * @param string    $expectedException  If set, the expected exception
     */
    public function testGet(array $contents, $id, $expected, $expectedException = '')
    {
        $container = new Container();
        foreach ($contents as $itemId => $item) {
            $container->set($itemId, $item);
        }

        if ($expectedException) {
            $this->setExpectedException($expectedException);
        }

        $this->assertEquals($expected, $container->get($id));
    }
}

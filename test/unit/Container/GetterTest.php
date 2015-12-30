<?php

namespace Choult\Tote\Test;

use \Mockery;
use \Choult\Tote\Test\Container\GetterTest\Double;

/**
 * @coversDefaultClass \Choult\Tote\Container\Getter
 */
class GetterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * DataProvider for testHas
     *
     * @return array
     */
    public function hasProvider()
    {
        return [
            'Happy path' => [
                'id' => 'test.item',
                'expected' => true
            ],
            'Method does not exist' => [
                'id' => 'test.item2',
                'expected' => false
            ]
        ];
    }

    /**
     * @dataProvider hasProvider
     *
     * @covers ::has
     * @covers ::getGetter
     *
     * @param string    $id                 The id to pass to ::get
     * @param mixed     $expected           The expected result of ::get($id)
     */
    public function testHas($id, $expected)
    {
        $container = new Double();

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
            'Happy path' => [
                'id' => 'test.item',
                'expected' => 'test result'
            ],
            'Method does not exist' => [
                'id' => 'test.item2',
                'expected' => false,
                'expectedException' => '\Choult\Tote\Container\Exception\ContainerException'
            ]
        ];
    }

    /**
     * @dataProvider getProvider
     *
     * @covers ::get
     * @covers ::getGetter
     *
     * @param string    $id                 The id to pass to ::get
     * @param mixed     $expected           The expected result of ::get($id)
     * @param string    $expectedException  If set, the expected exception
     */
    public function testGet($id, $expected, $expectedException = '')
    {
        $container = new Double();

        if ($expectedException) {
            $this->setExpectedException($expectedException);
        }

        $this->assertEquals($expected, $container->get($id));
        $this->assertEquals($expected, $container->get($id), 'Test caching');
    }
}

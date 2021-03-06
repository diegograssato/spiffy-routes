<?php

namespace SpiffyRoutesTest\Listener;

use ArrayObject;
use SpiffyRoutes\Annotation\Root;
use SpiffyRoutes\Listener\ControllerListener;
use SpiffyTest\Framework\TestCase;
use Zend\EventManager\Event;

class ControllerListenerTest extends TestCase
{
    public function testHandleRoot()
    {
        $listener   = new ControllerListener();
        $annotation = new Root(array('value' => '/foo'));
        $spec       = new ArrayObject();

        $event = new Event();
        $event->setParam('controllerSpec', $spec);

        $listener->handleRoot($event);

        $this->assertCount(0, $spec);

        $event->setParam('annotation', $annotation);
        $listener->handleRoot($event);

        $this->assertCount(1, $spec);
        $this->assertArrayHasKey('root', $spec);
        $this->assertEquals('/foo', $spec['root']);
    }
}
<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
use Spryker\Zed\Event\Dependency\EventCollection;

class ProductPageSearchAvailabilitySubscriberTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Subscriber\ProductPageSearchAvailabilitySubscriber
     */
    protected $subscriber;

    /**
     * @var \Spryker\Zed\Event\Dependency\EventCollection|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventCollectionMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->eventCollectionMock = $this->getMockBuilder(EventCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->subscriber = new ProductPageSearchAvailabilitySubscriber();
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents()
    {
        $this->eventCollectionMock->expects($this->once())
            ->method('addListenerQueued');

        $this->subscriber->getSubscribedEvents($this->eventCollectionMock);
    }
}

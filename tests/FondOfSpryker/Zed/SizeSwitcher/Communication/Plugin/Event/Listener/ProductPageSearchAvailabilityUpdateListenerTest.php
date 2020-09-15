<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\SizeSwitcher\Business\SizeSwitcherFacade;

class ProductPageSearchAvailabilityUpdateListenerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Business\SizeSwitcherFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Listener\ProductPageSearchAvailabilityUpdateListener
     */
    protected $listener;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before(); // TODO: Change the autogenerated stub

        $this->facadeMock = $this->getMockBuilder(SizeSwitcherFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->listener = new ProductPageSearchAvailabilityUpdateListener();
        $this->listener->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testHandleBulk()
    {
        $eventEntityTransfer = include codecept_data_dir('EventEntityTransfer.php');
        $eventEntityTransferCollection = [
            $eventEntityTransfer,
        ];

        $this->facadeMock->expects($this->once())
            ->method('update');

        $this->listener->handleBulk($eventEntityTransferCollection, 'EVENT_NAME');
    }
}

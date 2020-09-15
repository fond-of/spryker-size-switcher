<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepository;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeBridge;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeBridge;

class SizeSwitcherFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Business\SizeSwitcherFacade
     */
    protected $facade;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Business\SizeSwitcherBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeBridge|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventBehaviorFacadeBridgeMock;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeBridge|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productPageSearchFacadeBridgeMock;

    protected function _before()
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(SizeSwitcherBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(SizeSwitcherRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeBridgeMock = $this->getMockBuilder(SizeSwitcherToEventBehaviorFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productPageSearchFacadeBridgeMock = $this->getMockBuilder(SizeSwitcherToProductPageSearchFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SizeSwitcherFacade();
        $this->facade->setFactory($this->factoryMock);
        $this->facade->setRepository($this->repositoryMock);
    }

    public function testUpdate()
    {
        $this->factoryMock->expects($this->once())
            ->method('getEventBehaviorFacade')
            ->willReturn($this->eventBehaviorFacadeBridgeMock);

        $this->eventBehaviorFacadeBridgeMock->expects($this->once())
            ->method('getEventTransferIds')
            ->willReturn([1, 2, 3]);

        $this->repositoryMock->expects($this->once())
            ->method('queryProductAbstractSkusByAvailabilityIds')
            ->willReturn(['SKU-1', 'SKU-2', 'SKU-3']);

        $this->repositoryMock->expects($this->once())
            ->method('queryProductAbstractIdsBySku')
            ->willReturn([11, 22, 33]);

        $this->factoryMock->expects($this->once())
            ->method('getProductPageSearchFacade')
            ->willReturn($this->productPageSearchFacadeBridgeMock);

        $this->productPageSearchFacadeBridgeMock->expects($this->once())
            ->method('publish');

        $eventEntityTransfer = include codecept_data_dir('EventEntityTransfer.php');
        $eventEntityTransferCollection = [
            $eventEntityTransfer,
        ];

        $this->facade->update($eventEntityTransferCollection);
    }
}

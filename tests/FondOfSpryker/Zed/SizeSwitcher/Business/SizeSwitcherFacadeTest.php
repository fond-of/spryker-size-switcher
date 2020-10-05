<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\SizeSwitcher\Business\Publisher\ProductAbstractPageSearchPublisher;

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
     * @var \FondOfSpryker\Zed\SizeSwitcher\Business\Publisher\ProductAbstractPageSearchPublisher|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $publisher;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(SizeSwitcherBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->publisher = $this->getMockBuilder(ProductAbstractPageSearchPublisher::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SizeSwitcherFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $eventEntityTransfer = include codecept_data_dir('EventEntityTransfer.php');
        $eventEntityTransferCollection = [
            $eventEntityTransfer,
        ];

        $this->factoryMock->expects($this->once())
            ->method('createProductAbstractPageSearchPublisher')
            ->willReturn($this->publisher);

        $this->publisher->expects($this->once())
            ->method('publish')
            ->with($eventEntityTransferCollection);

        $this->facade->update($eventEntityTransferCollection);
    }
}

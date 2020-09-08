<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade;

interface SizeSwitcherToEventBehaviorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array;
}

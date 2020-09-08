<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class SizeSwitcherToEventBehaviorFacadeBridge implements SizeSwitcherToEventBehaviorFacadeInterface
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacade;

    public function __construct(EventBehaviorFacadeInterface $eventBehaviorFacade)
    {
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array
    {
        return $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);
    }
}

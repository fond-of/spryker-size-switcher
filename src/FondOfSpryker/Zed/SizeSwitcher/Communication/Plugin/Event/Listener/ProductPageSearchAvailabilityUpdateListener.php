<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\Event\Listener\AbstractProductPageSearchListener;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Business\SizeSwitcherFacadeInterface getFacade()
 */
class ProductPageSearchAvailabilityUpdateListener extends AbstractProductPageSearchListener implements EventBulkHandlerInterface
{
    use TransactionTrait;

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName): void
    {
        $this->getFacade()
            ->update($eventTransfers);
    }
}

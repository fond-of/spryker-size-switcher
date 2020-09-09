<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\Event\Listener\AbstractProductPageSearchListener;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\SizeSwitcher\Communication\SizeSwitcherCommunicationFactory getFactory()
 */
class ProductPageSearchAvailabilityUpdateListener extends AbstractProductPageSearchListener implements EventBulkHandlerInterface
{
    use DatabaseTransactionHandlerTrait;

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
        $this->preventTransaction();

        $availabiltyIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($eventTransfers);

        if (empty($availabiltyIds)) {
            return;
        }

        $productAbstractSkus = $this->getQueryContainer()
            ->queryProductAbstractSkusByAvailabilityIds($availabiltyIds)
            ->find()
            ->getData();

        if (empty($productAbstractSkus)) {
            return;
        }

        $productAbstractIds = $this->getQueryContainer()
            ->queryProductAbstractIdsBySku($productAbstractSkus)
            ->find()
            ->getData();

        if (empty($productAbstractIds)) {
            return;
        }

        $this->getFactory()
            ->getProductPageSearchFacade()
            ->publish($productAbstractIds);
    }
}

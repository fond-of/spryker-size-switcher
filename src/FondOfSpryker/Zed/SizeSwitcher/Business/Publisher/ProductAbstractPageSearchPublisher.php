<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business\Publisher;

use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface;

class ProductAbstractPageSearchPublisher implements ProductAbstractPageSearchPublisherInterface
{
    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeFacade;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface
     */
    protected $sizeSwitcherRepository;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface
     */
    protected $productPageSearchFacade;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacade;

    /**
     * @param \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface $productPageSearchFacade
     * @param \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface $sizeSwitcherRepository
     */
    public function __construct(
        SizeSwitcherToStoreFacadeInterface $storeFacade,
        SizeSwitcherToEventBehaviorFacadeInterface $eventBehaviorFacade,
        SizeSwitcherToProductPageSearchFacadeInterface $productPageSearchFacade,
        SizeSwitcherRepositoryInterface $sizeSwitcherRepository
    ) {
        $this->storeFacade = $storeFacade;
        $this->sizeSwitcherRepository = $sizeSwitcherRepository;
        $this->productPageSearchFacade = $productPageSearchFacade;
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfer
     *
     * @return void
     */
    public function publish(array $eventTransfer): void
    {
        $availabiltyIds = $this->getAvailabilityIdsFromEventTransfer($eventTransfer);

        if ($availabiltyIds === null) {
            return;
        }

        $productAbstractSkus = $this->queryProductAbstractSkuByAvailabilityIds($availabiltyIds);

        if ($productAbstractSkus === null) {
            return;
        }

        $productAbstractIds = $this->queryProductAbstractIdsBySku($productAbstractSkus);

        if ($productAbstractIds === null) {
            return;
        }

        $this->productPageSearchFacade->publish($productAbstractIds);
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfer
     *
     * @return array|null
     */
    protected function getAvailabilityIdsFromEventTransfer(array $eventTransfer): ?array
    {
        $availabiltyIds = $this->eventBehaviorFacade
            ->getEventTransferIds($eventTransfer);

        return !empty($availabiltyIds) ? $availabiltyIds : null;
    }

    /**
     * @param int[] $availabiltyIds
     *
     * @return string[]|null
     */
    protected function queryProductAbstractSkuByAvailabilityIds(array $availabiltyIds): ?array
    {
        $productAbstractSkus = $this->sizeSwitcherRepository->
            queryProductAbstractSkuByAvailabilityIds($availabiltyIds, $this->storeFacade->getCurrentStore()->getIdStore());

        return !empty($productAbstractSkus) ? $productAbstractSkus : null;
    }

    /**
     * @param int[] $productAbstractSkus
     *
     * @return int[]|null
     */
    protected function queryProductAbstractIdsBySku(array $productAbstractSkus): ?array
    {
        $productAbstractIds = $this->sizeSwitcherRepository->queryProductAbstractIdsBySku($productAbstractSkus);

        return !empty($productAbstractIds) ? $productAbstractIds : null;
    }
}

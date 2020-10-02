<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Subscriber;

use FondOfSpryker\Zed\SizeSwitcher\Communication\Plugin\Event\Listener\ProductPageSearchAvailabilityUpdateListener;
use Spryker\Zed\Availability\Dependency\AvailabilityEvents;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Business\SizeSwitcherFacadeInterface getFacade()
 */
class ProductPageSearchAvailabilitySubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addAvailabilityUpdateListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addAvailabilityUpdateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(AvailabilityEvents::ENTITY_SPY_AVAILABILITY_UPDATE, new ProductPageSearchAvailabilityUpdateListener());
    }
}

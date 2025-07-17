<?php

namespace CronixAvantLink\Storefront\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Storefront\Page\Checkout\Finish\CheckoutFinishPageLoadedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Shopware\Core\Framework\Struct\ArrayStruct;

/**
 * OrderTrackingSubscriber
 * 
 * Handles AvantLink affiliate tracking for completed orders.
 * This subscriber ensures that tracking scripts are only executed once per order
 * to prevent duplicate tracking and maintain accurate affiliate statistics.
 * 
 * @package CronixAvantLink\Storefront\Subscriber
 * @author Suprabhat Joshi
 * @version 1.0.0
 * @copyright Copyright © 2025 Cronix Digital
 */
class OrderTrackingSubscriber implements EventSubscriberInterface
{
    /**
     * Request stack service for accessing session data
     * 
     * @var RequestStack
     */
    private RequestStack $requestStack;

    /**
     * Constructor
     * 
     * Initializes the subscriber with the request stack service
     * which provides access to the current request and session data.
     * 
     * @param RequestStack $requestStack The request stack service
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * Get subscribed events
     * 
     * Defines which events this subscriber listens to and maps them
     * to their corresponding handler methods. This subscriber listens
     * to the checkout finish page loaded event to handle order tracking.
     * 
     * @return array Array of event mappings
     */
    public static function getSubscribedEvents(): array
    {
        return [
            CheckoutFinishPageLoadedEvent::class => 'onCheckoutFinishLoaded',
        ];
    }

    /**
     * Handle checkout finish page loaded event
     * 
     * This method is triggered when the checkout finish page is loaded.
     * It implements a one-time tracking mechanism to ensure AvantLink
     * affiliate tracking scripts are only executed once per order,
     * preventing duplicate tracking and maintaining data integrity.
     * 
     * @param CheckoutFinishPageLoadedEvent $event The checkout finish page loaded event
     * @return void
     */
    public function onCheckoutFinishLoaded(CheckoutFinishPageLoadedEvent $event): void
    {
        // Get the current session from the request stack
        $session = $this->requestStack->getSession();
        
        // Extract the order object from the event page
        $order = $event->getPage()->getOrder();

        // Early return if no order is available
        if (!$order) {
            return;
        }

        // Create a unique session key for this specific order
        // This prevents duplicate tracking if the page is refreshed
        $key = 'avantlink_tracked_' . $order->getOrderNumber();
        
        // Check if this order has already been tracked
        $isTracked = $session->get($key, false);

        // First time -> show script and then set flag
        if (!$isTracked) {
            // Mark this order as tracked in the session
            $session->set($key, true);

            // Only for this page render: mark as show script
            // This tells the template to render the AvantLink tracking script
            $event->getPage()->addExtension('isAvantLinkTracked', new ArrayStruct([
                'tracked' => true
            ]));
        } else {
            // Already tracked, no script
            // This prevents duplicate tracking on page refresh
            $event->getPage()->addExtension('isAvantLinkTracked', new ArrayStruct([
                'tracked' => false
            ]));
        }
    }
}
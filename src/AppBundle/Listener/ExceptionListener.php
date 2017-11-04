<?php
declare(strict_types=1);

namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ExceptionListener
 * @package AppBundle\Listener
 */
class ExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $event->setResponse(new Response($event->getException()->getMessage()));
    }
}

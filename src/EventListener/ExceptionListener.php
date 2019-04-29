<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        switch ($exception) {
            case $exception instanceof \InvalidArgumentException:
            case $exception instanceof \RangeException:
                $statusCode = Response::HTTP_BAD_REQUEST;
                break;
            default:
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $message = sprintf(
            '%s with code: %s',
            $exception->getMessage(),
            $statusCode
        );

        $response = new JsonResponse($message, $statusCode);
        if ($exception instanceof HttpExceptionInterface) {
            $response->headers->replace($exception->getHeaders());
        }

        $event->setResponse($response);
    }
}

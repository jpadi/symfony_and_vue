<?php

namespace App\PersonModule\Middleware;


use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CorsMiddleware
{
    public function onKernelResponse(ResponseEvent $event)
    {

        if (!$event->isMainRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $response = $event->getResponse();

        $response->headers->add([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
            "Access-Control-Allow-Headers"=> "Origin, Content-Type"
            //"Access-Control-Max-Age" => 86400
        ]);
    }
}
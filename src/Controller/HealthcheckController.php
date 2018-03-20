<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthcheckController extends FOSRestController
{
    /**
     * @Annotations\Get(path="/ping")
     */
    public function getAction()
    {
        return new JsonResponse(
            'pong'
        );
    }
}

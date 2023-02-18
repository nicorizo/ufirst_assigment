<?php

namespace Log\Adapter\Framework\Http\Controller;

use Log\Application\UseCase\Log\GetLogResponseHTTPCodeDistribution\GetLogResponseHTTPCodeDistribution;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LogGetResponseHTTPCodeDistributionController extends AbstractController
{
    public function __construct(
        private readonly GetLogResponseHTTPCodeDistribution $getLogRequestHTTPCodeDistributionService
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse($this->getLogRequestHTTPCodeDistributionService->handle(), 200);
    }

}
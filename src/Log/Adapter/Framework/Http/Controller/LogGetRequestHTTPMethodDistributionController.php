<?php

namespace Log\Adapter\Framework\Http\Controller;

use Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution\GetLogRequestHTTPMethodDistribution;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LogGetRequestHTTPMethodDistributionController extends AbstractController
{
    public function __construct(
        private readonly GetLogRequestHTTPMethodDistribution $getLogRequestHTTPMethodDistributionService
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse($this->getLogRequestHTTPMethodDistributionService->handle(), 200);
    }

}
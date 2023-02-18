<?php

namespace Log\Adapter\Framework\Http\Controller;


use Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\DTO\GetLogResponseByCodeAndSizeInputDTO;
use Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\GetLogResponseByCodeAndSize;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LogGetResponseByCodeAndSizeDistributionController extends AbstractController
{
    public function __construct(
        private readonly GetLogResponseByCodeAndSize $getLogResponseByCodeAndSizeService
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $code = $request->query->get('code', 200);
        $size = $request->query->get('size', 1000);
        return new JsonResponse($this->getLogResponseByCodeAndSizeService->handle(GetLogResponseByCodeAndSizeInputDTO::create($code, $size)), 200);
    }

}
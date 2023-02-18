<?php

namespace Log\Adapter\Framework\Http\Controller;

use Log\Application\UseCase\Log\GetLogRequestPerMinute\GetLogRequestPerMinute;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LogGetRequestPerMinuteController extends AbstractController
{
    public function __construct(
        private readonly GetLogRequestPerMinute $getLogRequestPerMinuteService
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse($this->getLogRequestPerMinuteService->handle(), 200);
    }

}
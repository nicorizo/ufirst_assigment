<?php

namespace Log\Adapter\Framework\Http\Controller;

use Log\Application\UseCase\Log\CreateJsonDataFile\CreateJsonDataFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LogShowController extends AbstractController
{
    public function __construct(
        private readonly CreateJsonDataFile    $createJsonDataFileService,
        private readonly ParameterBagInterface $params,
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        if (!file_exists($this->params->get('EPA_HTTP_DATA_JSON_FILE'))) {
            $this->createJsonDataFileService->handle();
        }

        return $this->render('@Log/public/log/show.html.twig', []);
    }

}
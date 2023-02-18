<?php

namespace Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution;


use Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution\DTO\GetLogRequestHTTPMethodDistributionOutputDTO;
use Log\Domain\Model\LogEntry;
use Log\Domain\Repository\LogRepository;

class GetLogRequestHTTPMethodDistribution
{

    public function __construct(
        private readonly LogRepository $repository
    )
    {
    }

    public function handle(): GetLogRequestHTTPMethodDistributionOutputDTO
    {
        $logEntries = $this->repository->findAll();

        $statusCodeDistribution = [];
        /** @var LogEntry $logEntry */

        foreach ($logEntries as $logEntry) {
            $method = $logEntry->getRequestMethod();
            if (!isset($statusCodeDistribution[$method])) {
                $statusCodeDistribution[$method] = 1;
            } else {
                $statusCodeDistribution[$method] = $statusCodeDistribution[$method] + 1;
            }
        }
        return new GetLogRequestHTTPMethodDistributionOutputDTO($statusCodeDistribution);
    }

}
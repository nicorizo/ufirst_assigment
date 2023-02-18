<?php

namespace Log\Application\UseCase\Log\GetLogResponseHTTPCodeDistribution;

use Log\Application\UseCase\Log\GetLogResponseHTTPCodeDistribution\DTO\GetLogResponseHTTPCodeDistributionOutputDTO;
use Log\Domain\Model\LogEntry;
use Log\Domain\Repository\LogRepository;

class GetLogResponseHTTPCodeDistribution
{
    public function __construct(
        private readonly LogRepository $repository
    )
    {
    }

    public function handle(): GetLogResponseHTTPCodeDistributionOutputDTO
    {
        $logEntries = $this->repository->findAll();
        $statusCodeDistribution = [];
        /** @var LogEntry $logEntry */
        foreach ($logEntries as $logEntry) {
            if (!isset($statusCodeDistribution[$logEntry->getResponseCode()])) {
                $statusCodeDistribution[$logEntry->getResponseCode()] = 1;
            } else {
                $statusCodeDistribution[$logEntry->getResponseCode()] = $statusCodeDistribution[$logEntry->getResponseCode()] + 1;
            }
        }
        return new GetLogResponseHTTPCodeDistributionOutputDTO($statusCodeDistribution);
    }

}
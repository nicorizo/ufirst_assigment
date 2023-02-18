<?php

namespace Log\Application\UseCase\Log\GetLogResponseByCodeAndSize;


use Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\DTO\GetLogResponseByCodeAndSizeInputDTO;
use Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\DTO\GetLogResponseByCodeAndSizeOutputDTO;
use Log\Domain\Model\LogEntry;
use Log\Domain\Repository\LogRepository;

class GetLogResponseByCodeAndSize
{
    public function __construct(
        private readonly LogRepository $repository
    )
    {

    }

    public function handle(GetLogResponseByCodeAndSizeInputDTO $inputDTO): GetLogResponseByCodeAndSizeOutputDTO
    {
        $logEntries = $this->repository->findAll();
        $distribution = [];
        /** @var LogEntry $logEntry */
        foreach ($logEntries as $logEntry) {
            if ($logEntry->getResponseSize() > $inputDTO->size || $logEntry->getResponseCode() !== $inputDTO->code) {
                continue;
            }
            $distribution[$logEntry->getResponseSize()] = isset($distribution[$logEntry->getResponseSize()]) ? $distribution[$logEntry->getResponseSize()] + 1 : 1;
        }
        ksort($distribution);

        return new GetLogResponseByCodeAndSizeOutputDTO($distribution);
    }

}
<?php

namespace Log\Application\UseCase\Log\GetLogRequestPerMinute;


use Log\Application\UseCase\Log\GetLogRequestPerMinute\DTO\GetLogRequestPerMinuteOutputDTO;
use Log\Domain\Model\LogEntry;
use Log\Domain\Repository\LogRepository;

class GetLogRequestPerMinute
{
    public function __construct(
        private readonly LogRepository $repository
    )
    {
    }

    public function handle(): GetLogRequestPerMinuteOutputDTO
    {
        $logEntries = $this->repository->findAll();
        $distribution = [];
        /** @var LogEntry $logEntry */
        foreach ($logEntries as $logEntry) {
            $datetime = $logEntry->getDatetime()->format('H:i');
            if (!isset($distribution[$datetime])) {
                $distribution[$datetime] = 1;
            } else {
                $distribution[$datetime] = $distribution[$datetime] + 1;
            }
        }
        return new GetLogRequestPerMinuteOutputDTO($distribution);
    }

}
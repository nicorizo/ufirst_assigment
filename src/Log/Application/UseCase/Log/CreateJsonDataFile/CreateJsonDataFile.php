<?php

namespace Log\Application\UseCase\Log\CreateJsonDataFile;

use Log\Adapter\Framework\Data\Json\Repository\JsonLogRepository;
use Log\Adapter\Framework\Data\Plain\Repository\PlainLogRepository;

class CreateJsonDataFile
{
    public function __construct(
        private readonly PlainLogRepository $plainLogRepository,
        private readonly JsonLogRepository $jsonLogRepository
    )
    {
    }

    public function handle()
    {
        foreach ($this->plainLogRepository->findAllLazy() as $logEntry) {
            $this->jsonLogRepository->persist($logEntry);
        }
        $this->jsonLogRepository->flush();
    }

}
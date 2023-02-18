<?php

namespace Log\Domain\Repository;

use Log\Domain\Model\LogEntry;

interface LogRepository
{
    public function findAll(): iterable;

    public function findAllLazy(): iterable;

    public function persist(LogEntry $logEntry): void;

    public function flush(): void;
}
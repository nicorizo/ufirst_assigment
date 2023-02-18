<?php

namespace Log\Adapter\Framework\Data\Plain\Repository;

use Log\Domain\Model\LogEntry;
use Log\Domain\Repository\LogRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PlainLogRepository implements LogRepository
{

    const REQUEST_METHODS = [
        'CONNECT',
        'DELETE',
        'GET',
        'HEAD',
        'OPTIONS',
        'POST',
        'PUT',
        'TRACE',
    ];

    public function __construct(
        private readonly ParameterBagInterface $params
    )
    {
    }

    public function findAll(): iterable
    {
        $file = $this->params->get('EPA_HTTP_DATA_PLAIN_FILE');

        if (false === $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) {
            return [];
        }

        $logEntries = [];
        foreach ($lines as $logEntry) {
            if (null !== $l = $this->mapTextEntryToLogEntry($logEntry)) {
                $logEntries[] = $l;
            }
        }

        return $logEntries;
    }

    public function findAllLazy(): iterable
    {
        $file = $this->params->get('EPA_HTTP_DATA_PLAIN_FILE');
        $f = fopen($file, "r") or die("Unable to open file!");
        while (!feof($f)) {
            if (null !== $l = $this->mapTextEntryToLogEntry(fgets($f))) {
                yield $l;
            }
        }
        fclose($f);
    }

    public function persist(LogEntry $logEntry): void
    {
        throw new \Exception('Must implement');
    }

    public function flush(): void
    {
        throw new \Exception('Must implement');
    }

    private function mapTextEntryToLogEntry(string $data): ?LogEntry
    {
        if (trim($data) === '') {
            return null;
        }
        //141.243.1.172 [29:23:53:25] "GET /Software.html HTTP/1.0" 200 1497
        //Split and get host
        $auxData = explode(' ', trim($data));
        $host = $auxData[0];
        $datetime = \DateTime::createFromFormat('\[d:H:i:s\]', $auxData[1]);
        //"GET /Software.html HTTP/1.0" 200 1497
        $auxRequestMethod = str_replace('"', '', $auxData[2]);
        $requestMethod = in_array($auxRequestMethod, self::REQUEST_METHODS) ? $auxRequestMethod : 'INVALID';
        $requestUrl = $auxData[3];

        try {
            $requestProtocolAndVersion = explode('/', str_replace('"', '', $auxData[4]));
            $requestProtocol = $requestProtocolAndVersion[0];
            $requestProtocolVersion = $requestProtocolAndVersion[1];
        } catch (\Exception $exception) {
            $requestProtocol = 'INVALID';
            $requestProtocolVersion = 'INVALID';
        }

        $responseCode = isset($auxData[5]) && intval($auxData[5]) < 600 && intval($auxData[5]) > 99 ? intval($auxData[5]) : 400;
        $responseSize = isset($auxData[6]) && intval($auxData[6]) > 0 ? intval($auxData[6]) : 0;


        return new LogEntry(
            $host,
            $datetime,
            $requestMethod,
            $requestUrl,
            $requestProtocol,
            $requestProtocolVersion,
            $responseCode,
            $responseSize,
        );
    }
}
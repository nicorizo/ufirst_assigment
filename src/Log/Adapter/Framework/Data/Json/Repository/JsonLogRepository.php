<?php

namespace Log\Adapter\Framework\Data\Json\Repository;

use Log\Domain\Model\LogEntry;
use Log\Domain\Repository\LogRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class JsonLogRepository implements LogRepository
{



    public function __construct(
        private readonly ParameterBagInterface $params,
        private array                          $items = [],
    )
    {
    }

    public function findAll(): iterable
    {
        $file = $this->params->get('EPA_HTTP_DATA_JSON_FILE');
        $arrayData = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);

        $result = [];
        foreach ($arrayData as $data) {
            $result[] = $this->mapArrayToLogEntry($data);
        }
        return $result;
    }

    public function findAllLazy(): iterable
    {
        $file = $this->params->get('EPA_HTTP_DATA_JSON_FILE');
        $arrayData = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);

        foreach ($arrayData as $data) {
            yield $this->mapArrayToLogEntry($data);
        }
    }

    public function persist(LogEntry $logEntry): void
    {
        $this->items[] = $logEntry;
    }

    public function flush(): void
    {
        if (count($this->items)) {
            $file = $this->params->get('EPA_HTTP_DATA_PLAIN_FILE');
            try {
                $logEntries = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {
                $logEntries = [];
            }

            foreach ($this->items as $item) {
                $logEntries[] = $this->mapLogEntryToArray($item);
            }
            $json = json_encode($logEntries, JSON_THROW_ON_ERROR, 512);
            file_put_contents($this->params->get('EPA_HTTP_DATA_JSON_FILE'), $json);
            $this->items = [];
            $logEntries = null;
        }
    }

    private function mapLogEntryToArray(LogEntry $logEntry): array
    {
        return [
            'host' => $logEntry->getHost(),
            'datetime' => [
                'day' => $logEntry->getDatetime()->format('d'),
                "hour" => $logEntry->getDatetime()->format('H'),
                "minute" => $logEntry->getDatetime()->format('i'),
                "second" => $logEntry->getDatetime()->format('s'),
            ],
            'request' => [
                "method" => $logEntry->getRequestMethod(),
                "url" => $logEntry->getRequestUrl(),
                "protocol" => $logEntry->getRequestProtocol(),
                "protocol_version" => $logEntry->getRequestProtocolVersion(),
            ],
            "response_code" => $logEntry->getResponseCode(),
            "document_size" => $logEntry->getResponseSize()
        ];
    }

    private function mapArrayToLogEntry(array $data): LogEntry
    {

        $logDate = \DateTime::createFromFormat('d:H:i:s', implode(':', $data['datetime']));

        return new LogEntry(
            $data['host'],
            $logDate,
            $data['request']['method'],
            $data['request']['url'],
            $data['request']['protocol'],
            $data['request']['protocol_version'],
            $data['response_code'],
            $data['document_size']);
    }

    public function save(LogEntry $logEntry): void
    {
        $file = $this->params->get('EPA_HTTP_DATA_PLAIN_FILE');
        $jsonFileContents = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);

        $jsonFileContents[] = $this->mapLogEntryToArray($logEntry);

        $json = json_encode($jsonFileContents, JSON_THROW_ON_ERROR, 512);
        file_put_contents($this->params->get('EPA_HTTP_DATA_JSON_FILE'), $json);
    }
}
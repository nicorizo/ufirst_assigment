<?php

namespace Log\Adapter\Framework\Command;

use Log\Application\UseCase\Log\CreateJsonDataFile\CreateJsonDataFile;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(
    name: 'app:create-json-data-file',
    description: 'Creates Json Data File and load data.',
    hidden: false,
)]
class CreateJsonDataFileCommand extends Command
{
    public function __construct(
        private readonly CreateJsonDataFile $createJsonDataFileService,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command allows you to Create Json Data File and load data.');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->createJsonDataFileService->handle();
        $output->writeln('Json Data File Create');
        return Command::SUCCESS;
    }

}
<?php

namespace App\Command;

use App\Command\Fetch\Description\DummyDescription;
use App\Command\Fetch\Handler\DummyHandler;
use App\Fetch\Analyzer\AnalyzerInterface;
use App\Fetch\Handler\HandlerInterface;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\RateApiDto;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\TypeApiDto;
use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class PullCommand extends Command
{
//region SECTION: Fields
    protected static               $defaultName = 'app:'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.':pull';
    private AnalyzerInterface $typeAnalyzer;
//endregion Fields

//region SECTION: Constructor
    public function __construct(AnalyzerInterface $typeAnalyzer)
    {
        parent::__construct();
        $this->typeAnalyzer  = $typeAnalyzer;
    }
//endregion Constructor

//region SECTION: Protected
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        parent::configure();

        $this
            ->setName(static::$defaultName)
            ->setDescription('Pull Exchange Rate data')
            ->setHelp(
                <<<'EOT'
The <info>evrinoma:menu:create</info> command pull exchange rate data and save it in database

  <info>php %command.full_name%</info>
EOT
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //@TODO refactor
        $handler = new DummyHandler(new DummyDescription());
        try {
            $output->writeln(['============']);
            $this->analizer($handler->run(), $output);
            $output->writeln(['============']);
        } catch (\Exception $e) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

//endregion Protected
//region SECTION: Private
    private function analizer(HandlerInterface $resource, OutputInterface $output): void
    {
        $data = $resource->getRaw();

        $rates = array_keys($data['rates']);
        $this->typeAnalyzer->doAnalyze($rates);

        $rate = new RateApiDto();
        $rate
            ->setCreated((new \DateTimeImmutable)->setTimestamp((int)$data['timestamp']))
            ->setBaseApiDto((new TypeApiDto())->setIdentity($data['base']));

        foreach ($resource->getData() as $key => $value) {
            $output->writeln('['.$key.']='.$value);
        }
    }
//endregion Private
}
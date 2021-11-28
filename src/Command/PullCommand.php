<?php

namespace App\Command;

use App\Command\Fetch\Description\DummyDescription;
use App\Command\Fetch\Handler\DummyHandler;
use App\Fetch\Analyzer\AnalyzerInterface;
use App\Fetch\Handler\HandlerInterface;
use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class PullCommand extends Command
{
//region SECTION: Fields
    protected static          $defaultName = 'app:'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.':pull';
    private AnalyzerInterface $typeAnalyzer;
    private AnalyzerInterface $rateAnalyzer;
//endregion Fields

//region SECTION: Constructor
    public function __construct(AnalyzerInterface $typeAnalyzer, AnalyzerInterface $rateAnalyzer)
    {
        parent::__construct();
        $this->typeAnalyzer = $typeAnalyzer;
        $this->rateAnalyzer = $rateAnalyzer;
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
            $this->analizers($handler->run(), $output);
        } catch (\Exception $e) {
            $output->writeln(['xxxxxxxxxxxx']);
            return Command::FAILURE;
        }

        $output->writeln(['============']);
        return Command::SUCCESS;
    }

//endregion Protected
//region SECTION: Private
    private function analizers(HandlerInterface $resource, OutputInterface $output): void
    {
        $data = $resource->getRaw();

        $this->typeAnalyzer->set($data['rates']);
        $this->typeAnalyzer->doAnalyze();

        $this->rateAnalyzer->set($data);
        $this->rateAnalyzer->doAnalyze();
    }
//endregion Private
}
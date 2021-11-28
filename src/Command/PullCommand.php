<?php

namespace App\Command;

use Evrinoma\ExchangeRateBundle\EvrinomaExchangeRateBundle;
use Evrinoma\FetchBundle\Analyzer\AnalyzerInterface;
use Evrinoma\FetchBundle\Handler\HandlerInterface;
use Evrinoma\FetchBundle\Manager\FetchManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class PullCommand extends Command
{
//region SECTION: Fields
    protected static              $defaultName = 'app:'.EvrinomaExchangeRateBundle::EXCHANGE_RATE_BUNDLE.':pull';
    private AnalyzerInterface     $typeAnalyzer;
    private AnalyzerInterface     $rateAnalyzer;
    private FetchManagerInterface $manager;
//endregion Fields

//region SECTION: Constructor
    public function __construct(FetchManagerInterface $manager, AnalyzerInterface $typeAnalyzer, AnalyzerInterface $rateAnalyzer)
    {
        parent::__construct();
        $this->manager      = $manager;
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
        $this->addOption('description', 'desc', InputOption::VALUE_REQUIRED, 'Configuration data source');
        $this->addOption('handler', 'hdl', InputOption::VALUE_REQUIRED, 'Handler processor');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $handler     = $input->getOption('handler');
        $description = $input->getOption('description');

        if ($handler && $description) {
            try {
                $handler = $this->manager->getHandler($handler, $description);

                $this->analizers($handler->run(), $output);
            } catch (\Exception $e) {
                $output->writeln(['xxxxxxxxxxxx', $e->getMessage(), 'xxxxxxxxxxxx']);

                return Command::FAILURE;
            }
        } else {
            $output->writeln(['handler and description not set']);
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
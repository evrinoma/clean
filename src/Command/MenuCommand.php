<?php


namespace App\Command;


use App\Manager\MenuManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MenuCommand extends Command
{
//region SECTION: Fields
    protected static $defaultName = 'menu:default';
    private          $menuManager;
//endregion Fields

//region SECTION: Constructor
    /**
     * CalcCommand constructor.
     */
    public function __construct(MenuManager $menuManager)
    {
        $this->menuManager = $menuManager;

        parent::__construct();
    }
//endregion Constructor

//region SECTION: Protected
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->menuManager->createDefaultMenu();
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }

        $output->writeln(['============', 'generate menu', '============',]);

        return 0;
    }
//endregion Protected
}
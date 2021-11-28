<?php

namespace App\Command\Analyzer;


use App\Fetch\Analyzer\AnalyzerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Manager\Type\CommandManager;
use Evrinoma\ExchangeRateBundle\Manager\Type\QueryManager;

class TypeAnalyzer implements AnalyzerInterface
{
//region SECTION: Fields
    private QueryManager           $typeQueryManager;
    private CommandManager         $typeCommandManager;
    private EntityManagerInterface $manager;
//endregion Fields

//region SECTION: Constructor
    public function __construct(EntityManagerInterface $manager, QueryManager $typeQueryManager, CommandManager $typeCommandManager)
    {
        $this->typeQueryManager   = $typeQueryManager;
        $this->typeCommandManager = $typeCommandManager;
        $this->manager            = $manager;
    }
//endregion Constructor

//region SECTION: Public
    public function doAnalyze(array $data)
    {
        $diff  = [];
        $dto   = new TypeApiDto();
        $types = $this->typeQueryManager->criteria($dto);
        /** @var TypeApiDtoInterface $type */
        foreach ($types as $type) {
            $identity = $type->getIdentity();
            if (in_array($identity, $data)) {
                unset($data[$identity]);
            }
        }

        try {
            $this->manager->transactional(
                function () use ($dto, $data) {
                    foreach ($data as $item) {
                        $dto->setIdentity($item);
                        try {
                            $this->typeCommandManager->post($dto);
                        } catch (\Exception $e) {
                            $message[] = $e->getCode();
                        }
                    }
                }
            );
        } catch (\Exception $e) {
            $message[] = $e->getCode();
        }
    }
//endregion Public
}
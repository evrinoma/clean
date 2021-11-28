<?php

namespace App\Command\Analyzer;

use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Exception\Type\TypeNotFoundException;
use Evrinoma\ExchangeRateBundle\Manager\Type\CommandManager;
use Evrinoma\ExchangeRateBundle\Manager\Type\QueryManager;
use Evrinoma\FetchBundle\Analyzer\AbstractAnalyzer;

class TypeAnalyzer extends AbstractAnalyzer
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
    public function doAnalyze()
    {
        $dto = new TypeApiDto();
        try {
            $types = $this->typeQueryManager->criteria($dto);
            /** @var TypeApiDtoInterface $type */
            foreach ($types as $type) {
                $identity = $type->getIdentity();
                if ($this->get($identity)) {
                    $this->rm($identity);
                }
            }
        } catch (TypeNotFoundException $e) {

        }
        try {
            $this->manager->transactional(
                function () use ($dto) {
                    foreach ($this->all() as $identity => $item) {
                        $dto->setIdentity($identity);
                        try {
                            $value = $this->typeCommandManager->post($dto);
                        } catch (\Exception $e) {
                            $this->addError((string)$e->getCode());
                        }
                    }
                }
            );
        } catch (\Exception $e) {
            $this->addError((string)$e->getCode());
            throw $e;
        }
    }
//endregion Public
}
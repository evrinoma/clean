<?php

namespace App\Command\Analyzer;

use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\RateApiDto;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\TypeApiDto;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Manager\Rate\CommandManager as RateCommandManager;
use Evrinoma\ExchangeRateBundle\Manager\Type\QueryManager as TypeQueryManager;
use Evrinoma\ExchangeRateBundle\Model\Type\TypeInterface;
use Evrinoma\FetchBundle\Analyzer\AbstractAnalyzer;

class RateAnalyzer extends AbstractAnalyzer
{
//region SECTION: Fields
    private TypeQueryManager       $typeQueryManager;
    private RateCommandManager     $rateCommandManager;
    private EntityManagerInterface $manager;
    private array                  $types = [];
//endregion Fields

//region SECTION: Constructor
    public function __construct(EntityManagerInterface $manager, TypeQueryManager $typeQueryManager, RateCommandManager $rateCommandManager)
    {
        $this->typeQueryManager   = $typeQueryManager;
        $this->rateCommandManager = $rateCommandManager;
        $this->manager            = $manager;
    }
//endregion Constructor

//region SECTION: Public
    public function doAnalyze()
    {
        $this->createPoxyType();

        if ($this->has('timestamp') && $this->has('base')) {
            $rate = new RateApiDto();
            $rate
                ->setCreated((new \DateTimeImmutable)->setTimestamp((int)$this->get('timestamp')))
                ->setBaseApiDto($this->getType($this->get('base')));

            if ($this->has('rates')) {
                $records = $this->createPoxyRate($rate);

                try {
                    $this->manager->transactional(
                        function () use ($records) {
                            foreach ($records as $dto) {
                                try {
                                    $value = $this->rateCommandManager->post($dto);
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
        }
    }
//endregion Public

//region SECTION: Private
    private function createPoxyType(): void
    {
        /** @var TypeInterface $type */
        foreach ($this->typeQueryManager->criteria(new TypeApiDto()) as $type) {
            $this->types[$type->getIdentity()] = (new TypeApiDto())->setId($type->getId());
        }
    }

    private function getType(string $identity): TypeApiDtoInterface
    {
        return array_key_exists($identity, $this->types) ? $this->types[$identity] : new TypeApiDto();
    }

    private function createPoxyRate(RateApiDtoInterface $dto): array
    {
        $records = [];

        foreach ($this->get('rates') as $identity => $value) {
            $clone = clone $dto;
            $clone->setTypeApiDto($this->getType($identity));
            $clone->setValue((float)$value);
            $records[] = $clone;
        }

        return $records;
    }
//endregion Private
}
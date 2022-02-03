<?php

namespace App\Command\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\Preserve\RateApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\RateApiDtoTrait;
use Evrinoma\ExchangeRateBundle\Dto\RateApiDto as BaseRateApiDto;

final class RateApiDto extends BaseRateApiDto implements RateApiDtoInterface
{
    use RateApiDtoTrait;
}
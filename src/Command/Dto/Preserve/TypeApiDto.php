<?php

namespace App\Command\Dto\Preserve;

use Evrinoma\ExchangeRateBundle\Dto\Preserve\TypeApiDtoInterface;
use Evrinoma\ExchangeRateBundle\Dto\Preserve\TypeApiDtoTrait;
use Evrinoma\ExchangeRateBundle\Dto\TypeApiDto as BaseTypeApiDto;

final class TypeApiDto extends BaseTypeApiDto implements TypeApiDtoInterface
{
    use TypeApiDtoTrait;
}
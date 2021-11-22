<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\CaseTest;
use App\Tests\Functional\DataFixtures\FixtureInterface;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestInterface;

final class InitialTest extends CaseTest implements ApiControllerTestInterface
{
//region SECTION: Fields
    public const API_GET      = 'ApiControllerTest::API_GET';
    public const API_CRITERIA = 'ApiControllerTest::API_CRITERIA';
    public const API_DELETE   = 'ApiControllerTest::API_DELETE';
    public const API_PUT      = 'ApiControllerTest::API_PUT';
    public const API_POST     = 'ApiControllerTest::API_POST';
//endregion Fields

//region SECTION: Protected
    protected static function defaultData(): array
    {
        $data['class'] = static::getDtoClass();

        return $data;
    }

    protected function getEntityClass(): string
    {
        return static::class;
    }
//endregion Protected

//endregion Private

//region SECTION: Public
    public function testGet(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testGetNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testCriteria(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testCriteriaNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPut(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPutNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPutUnprocessable(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testDelete(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testDeleteNotFound(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testDeleteUnprocessable(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPost(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPostDuplicate(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testPostUnprocessable(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [FixtureInterface::FOS_USER_FIXTURES];
    }

    public static function getDtoClass(): string
    {
        return static::class;
    }
//endregion Getters/Setters
}
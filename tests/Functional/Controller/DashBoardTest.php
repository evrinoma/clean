<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\CaseTest;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestInterface;
use Symfony\Component\HttpFoundation\Response;

final class DashBoardTest extends CaseTest implements ApiControllerTestInterface
{
//region SECTION: Fields
    public const API_GET      = '/evrinoma/api/dashboard/status';
    public const API_CRITERIA = '/';
    public const API_DELETE   = '/';
    public const API_PUT      = '/';
    public const API_POST     = '/';
//endregion Fields

//region SECTION: Protected
    protected static function defaultData(): array
    {
        return [];
    }

//endregion Protected

//region SECTION: Public

//endregion Private
    public function testGet(): void
    {
        $response = $this->queryGet([]);
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->checkResult($response);
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

//region SECTION: Private
    private function checkResult($entity): void
    {
        $this->assertArrayHasKey('system', $entity);
        $this->assertArrayHasKey('procinfo', $entity['system']);
        $this->assertArrayHasKey('sysinfo', $entity['system']);
    }
//endregion Private

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [];
    }

    public static function getDtoClass(): string
    {
        return static::class;
    }
//endregion Getters/Setters
}
<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 28/03/2020
 * Time: 16:31.
 */

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Entity\French;
use App\Handler\FrenchHandler;
use App\Manager\FrenchManager;
use App\Tests\AbstractHandlerTest;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class FrenchHandlerTest
 *
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
*/
class FrenchHandlerTest extends AbstractHandlerTest
{
    protected FrenchHandler $frenchHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = $this->prophesize(FrenchManager::class);
        $this->frenchHandler  = new FrenchHandler(
            $this->manager->reveal(),
            $this->serializerHandler->reveal(),
            $this->client->reveal()
        );
    }

    public function testRetrieveById()
    {
        $this->mockGetSerializer();
        $this->mockSearch('id', $this->frenchModel->getId(), $this->frenchDataFormated);

        $this->assertEquals(
            $this->frenchModel,
            $this->frenchHandler->retrieveById($this->frenchModel->getId())
        );
    }

    public function testSearch()
    {
        $this->mockGetSerializer();
        $this->mockSearch('word', $this->frenchModel->getWord(), $this->frenchDataFormated);

        $this->assertEquals(
            $this->frenchModel,
            $this->frenchHandler->search('word', $this->frenchModel->getWord())
        );
    }

    public function testGetFrenchs(): void
    {
        $this->mockRetrieveEntitiesList([$this->frenchModel]);
        $this->assertEquals(
            [$this->frenchModel],
            $this->frenchHandler->retrieveAll()
        );
    }

    public function testCreate(): void
    {
        $this->mockManagerSave($this->frenchModel);
        $this->assertNull(
            $this->frenchHandler->create($this->frenchModel)
        );
    }

    public function testUpdate(): void
    {
        $this->mockManagerSave($this->frenchModel);
        $this->assertNull(
            $this->frenchHandler->update($this->frenchModel)
        );
    }

    /**
     * @throws ExceptionInterface
     */
    public function testDeleteById(): void
    {
        $this->mockGetSerializer();
        $this->mockSearch('id', $this->frenchModel->getId(), $this->frenchDataFormated);

        $this->mockDeleteEntity($this->frenchModel);

        $this->assertNull(
            $this->frenchHandler->deleteById($this->frenchModel->getId())
        );
    }

    /**
     * array
     */
    public function frenchProvider(): array
    {
        return [
          [(new French())
              ->setId(5)
              ->setWord('mot - 4')
              ->setUrl('/public/bundles/main/audio/french/5.mp3')
              ->setType('type - 4')
              ->setStatus(true)
              ->setCreatedAt(new \DateTime('2020-04-15T10:11:28+02:00'))
              ->setUpdatedAt(new \DateTime('2020-09-04T19:05:59+02:00'))],
          [null],
        ];
    }
}

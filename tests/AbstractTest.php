<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use App\Entity\French;
use App\Entity\Page;
use App\Entity\Sango;
use App\Entity\Unknown;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractTest.
 */
class AbstractTest extends TestCase
{
    /**
     * @var ObjectProphecy
     */
    protected $em;

    /**
     * @var Page|ObjectProphecy
     */
    protected $pageModel;

    /**
     * @var Unknown|ObjectProphecy
     */
    protected $unknownModel;

    /**
     * @var French|ObjectProphecy
     */
    protected $frenchModel;

    /**
     * @var French|ObjectProphecy
     */
    protected $sangoModel;

    /**
     * @var array
     */
    protected $frenchDataFormated;

    protected function setUp(): void
    {
        $this->em = $this->prophesize(EntityManagerInterface::class);

        $this->pageModel = (new Page())
            ->setId(6)
            ->setTitle('title page - 5')
            ->setLanguage('French')
            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor')
            ->setCreatedAt(new \DateTime('2020-04-15 10:11:28'))
            ->setUpdatedAt(new \DateTime('2020-04-15 10:11:28'));

        $this->unknownModel = (new Unknown())
            ->setId(5)
            ->setWord('title unknown Pock')
            ->setSource('French')
            ->setTarget('Sango')
            ->setOrigin('app');

        $this->frenchModel = (new French())
            ->setId(5)
            ->setWord('mot - 4')
            ->setUrl('/public/bundles/main/audio/french/5.mp3')
            ->setType('type - 4')
            ->setStatus(true)
            ->setCreatedAt(new \DateTime('2020-04-15T10:11:28+02:00'))
            ->setUpdatedAt(new \DateTime('2020-09-04T19:05:59+02:00'))
            ;

        $this->sangoModel = (new Sango())
            ->setWord('mot sango - 5')
            ->setDescription('description sango - 5')
            ->setExemple('exemple sango - 5')
            ->setUrl('/public/bundles/main/audio/sango/6.mp3')
            ->setType('type sango - 5')
            ->setLanguage('Sango')
            ->setStatus(true)
            ->setCreatedAt(new \DateTime('2020-04-15 10:11:28'))
            ->setUpdatedAt(new \DateTime('2020-04-15 10:11:28'))
        ;

        $this->frenchDataFormated = [
            "id" => 5,
            "word" => "mot - 4",
            "type" => "type - 4",
            "status" => true,
            "url" => "/public/bundles/main/audio/french/5.mp3",
            "created_at" => \DateTime::createFromFormat('Y-m-d\TH:i:sP', "2020-04-15T10:11:28+02:00"),
            "updated_at" => \DateTime::createFromFormat('Y-m-d\TH:i:sP', "2020-09-04T19:05:59+02:00")
        ];
    }
}

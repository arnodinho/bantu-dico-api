<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use App\Entity\Page;
use App\Entity\Unknown;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractTest.
 */
class AbstractTest extends TestCase
{
    /**
     * @var Page|ObjectProphecy
     */
    protected $pageModel;

    /**
     * @var Unknown|ObjectProphecy
     */
    protected $unknownModel;

    protected function setUp(): void
    {
        $this->pageModel = (new Page())
            ->setId(5)
            ->setTitle('title Mock Pock')
            ->setLanguage('FR')
            ->setContent('atzsjsd sukdgskudhqs skdh sdfksdh  sdifhsd')
            ->setCreatedAt(new \DateTime('now'))
            ->setUpdatedAt(new \DateTime('now'));

        $this->unknownModel = (new Unknown())
            ->setId(5)
            ->setWord('title unknown Pock')
            ->setSource('French')
            ->setTarget('Sango')
            ->setOrigin('app');
    }
}

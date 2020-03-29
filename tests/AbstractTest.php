<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 29/03/2020
 * Time: 20:44.
 */

namespace App\Tests;

use App\Entity\Page;
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

    protected function setUp(): void
    {
        $this->pageModel = (new Page())
            ->setId(5)
            ->setTitle('title Mock Pock')
            ->setLanguage('FR')
            ->setContent('atzsjsd sukdgskudhqs skdh sdfksdh  sdifhsd')
            ->setCreatedAt(new \DateTime('now'))
            ->setUpdatedAt(new \DateTime('now'));
    }
}

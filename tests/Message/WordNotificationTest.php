<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 25/09/2020
 * Time: 15:06.
 */

namespace App\Tests\Message;

use App\Message\WordNotification;
use PHPUnit\Framework\TestCase;

class WordNotificationTest extends TestCase
{
    protected WordNotification $worNotification;

    protected function setUp(): void
    {
        $this->worNotification = new WordNotification(5);
    }

    public function testGetFrenchSangoId()
    {
        $this->assertEquals(
            5,
            $this->worNotification->getFrenchSangoId()
        );
    }
}

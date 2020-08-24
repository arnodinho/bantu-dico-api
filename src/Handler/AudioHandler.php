<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 24/08/2020
 * Time: 12:50.
 */

namespace App\Handler;

use App\Message\SmsNotification;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class AudioHandler.
 */
class AudioHandler
{
    /**
     * @var MessageBusInterface
     */
    protected $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function import(int $begin, int $end = null)
    {
        $this->bus->dispatch(new SmsNotification($begin));

        return 'ok';
    }
}

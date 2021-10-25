<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 24/08/2020
 * Time: 12:50.
 */

namespace App\Handler;

use App\Manager\FrenchSangoManager;
use App\Message\WordNotification;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class AudioHandler.
 */
class AudioHandler
{
    private const IMPORT_SUCCES = 'data audio created successfully';

    /**
     * @var MessageBusInterface
     */
    protected $bus;

    /**
     * @var FrenchSangoManager
     */
    private $frenchSangoManager;

    public function __construct(MessageBusInterface $bus, FrenchSangoManager $frenchSangoManager)
    {
        $this->bus = $bus;
        $this->frenchSangoManager = $frenchSangoManager;
    }

    public function import(int $begin, int $end = null): string
    {
        $end = $end ?? $this->frenchSangoManager->getRepository()->findMaxId();
        for ($id = $begin; $id <= $end; ++$id) {
            $this->bus->dispatch(new WordNotification($id));
        }

        return self::IMPORT_SUCCES;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 24/08/2020
 * Time: 13:15.
 */

namespace App\Message;

/**
 * Class WordNotification.
 */
class WordNotification
{
    /**
     * @var int
     */
    private $frenchSangoId;

    /**
     * WordNotification constructor.
     */
    public function __construct(int $frenchSangoId)
    {
        $this->frenchSangoId = $frenchSangoId;
    }

    public function getFrenchSangoId(): int
    {
        return $this->frenchSangoId;
    }
}

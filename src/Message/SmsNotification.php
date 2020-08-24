<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 24/08/2020
 * Time: 13:15.
 */

namespace App\Message;

/**
 * Class SmsNotification.
 */
class SmsNotification
{
    /**
     * @var int
     */
    private $frenchSangodId;

    /**
     * SmsNotification constructor.
     */
    public function __construct(int $frenchSangodId)
    {
        $this->frenchSangodId = $frenchSangodId;
    }

    public function getFrenchSangodId(): int
    {
        return $this->frenchSangodId;
    }
}

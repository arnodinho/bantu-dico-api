<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 13/04/2020
 * Time: 18:45.
 */

namespace App\Controller;

use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BaseController.
 */
class BaseController extends AbstractController
{
    public const MESG_SUCCESSFULL_OPERATION = 'Successful operation';

    /**
     * @param int $code
     * @param string $message
     * @return View
     */
    public function sendMessage(int $code, string $message)
    {
        return View::create([['code' => $code, 'message' => $message]], $code);
    }
}

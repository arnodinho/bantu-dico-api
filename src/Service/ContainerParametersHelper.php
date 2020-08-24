<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 24/08/2020
 * Time: 17:51.
 */

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContainerParametersHelper
{
    /**+
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * This method returns the root directory of your Symfony 4 project.
     *
     * e.g "/var/www/vhosts/myapplication"
     */
    public function getApplicationRootDir(): string
    {
        return $this->params->get('kernel.project_dir');
    }

    /**
     * This method returns the value of the defined parameter.
     *
     * @return mixed
     */
    public function getParameter(string $parameterName): ?string
    {
        return $this->params->get($parameterName);
    }
}

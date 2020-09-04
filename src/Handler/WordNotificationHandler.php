<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 24/08/2020
 * Time: 13:13.
 */

namespace App\Handler;

use App\Entity\StorableEntityInterface;
use App\Manager\FrenchManager;
use App\Manager\FrenchSangoManager;
use App\Manager\SangoManager;
use App\Message\WordNotification;
use App\Service\ContainerParametersHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class WordNotificationHandler.
 */
class WordNotificationHandler implements MessageHandlerInterface
{
    /**
     * @var FrenchManager
     */
    private $frenchManager;

    /**
     * @var SangoManager
     */
    private $sangoManager;

    /**
     * @var FrenchSangoManager
     */
    private $frenchSangoManager;

    /**
     * @var ContainerParametersHelper
     */
    private $containerParametersHelper;

    public function __construct(
        FrenchManager $frenchManager,
        SangoManager $sangoManager,
        FrenchSangoManager $frenchSangoManager,
        ContainerParametersHelper $containerParametersHelper
    ) {
        $this->frenchManager = $frenchManager;
        $this->sangoManager = $sangoManager;
        $this->frenchSangoManager = $frenchSangoManager;
        $this->containerParametersHelper = $containerParametersHelper;
    }

    /**
     * @throws GuzzleException
     */
    public function __invoke(WordNotification $message)
    {
        $frenchSango = $this->frenchSangoManager->getRepository()->find($message->getFrenchSangoId());
        $this->download($frenchSango->getFrench(), 'fr');
        $this->download($frenchSango->getSango(), 'es');
    }

    /**
     * @throws GuzzleException
     */
    private function download(
        StorableEntityInterface $entity,
        string $language
    ): void {
        // create file path with mp3 extension
        $path = sprintf(
            '%s%s',
            $this->containerParametersHelper->getApplicationRootDir(),
            $entity::PATH_AUDIO
        );

        $file = sprintf('%s%d.mp3', $path, $entity->getId());

        // verify CHMOD
        if ('0777' != substr(sprintf('%o', fileperms($path)), -4)) {
            chmod($path, 0777);
        }

        $client = new Client();

        // If MP3 file exists do not create new request
        if (!file_exists($file)) {
            $mp3 = $client
                ->request('GET', 'http://translate.google.com/translate_tts', [
                    'query' => [
                        'ie' => 'UTF-8',
                        'total' => 1,
                        'idx' => 0,
                        'textlen' => 32,
                        'client' => 'tw-ob',
                        'q' => $entity->getWord(),
                        'tl' => $language,
                    ],
                ]);

            if (Response::HTTP_OK === $mp3->getStatusCode()) {
                $contents = $mp3->getBody()->getContents();

                file_put_contents($file, $contents);
                chmod($file, 0777);  // notation octale : valeur du mode correcte
            }
        }

        //save url of audio file  in database
        $entity->setUrl(sprintf('%s%d.mp3', $entity::PATH_AUDIO, $entity->getId()));
        $this->frenchManager->save($entity);
    }
}

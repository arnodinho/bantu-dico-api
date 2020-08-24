<?php
/**
 * Created by PhpStorm.
 * User: arnaudyanga <arnaud.yanga@believedigital.com>
 * Date: 14/08/2020
 * Time: 17:29.
 */

namespace App\Command;

use App\Handler\AudioHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportAudioCommand.
 */
class ImportAudioCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'audio:import';

    /**
     * @var AudioHandler
     */
    private AudioHandler $audioHandler;

    public function __construct(AudioHandler $audioHandler)
    {
        $this->audioHandler = $audioHandler;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Import audios for word definition')
            ->addArgument('begin', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('end', InputArgument::OPTIONAL, 'The username of the user.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a audio file for word definition...')
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $begin = intval($input->getArgument('begin'));
        $end   = intval($input->getArgument('end'));


        if (isset($end) && $end < $begin) {
            return $output->writeln('le deuxieme argument doit etre superieur au premier');
        }

        return $output->writeln($this->audioHandler->import($begin, $end));
    }
}
